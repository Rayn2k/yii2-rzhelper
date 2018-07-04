<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use rayn2k\rzhelper\UtilAuthorization;
use rayn2k\rzhelper\ConstantsGeneral;
use rayn2k\rzhelper\Debug;

/**
 * UserSearch represents the model behind the search form about
 * `app\models\User`.
 */
class UserSearch extends User
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [
                        [
                                'id',
                                'status',
                                'superadmin',
                                'created_at',
                                'updated_at',
                                'email_confirmed'
                        ],
                        'integer'
                ],
                [
                        [
                                'username',
                                'auth_key',
                                'password_hash',
                                'confirmation_token',
                                'registration_ip',
                                'bind_to_ip',
                                'email'
                        ],
                        'safe'
                ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params            
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find();
        
        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
                'query' => $query
        ]);
        
        $this->load($params);
        
        if (! $this->validate()) {
            // uncomment the following line if you do not want to return any
            // records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        // grid filtering conditions
        $query->andFilterWhere(
                [
                        'id' => $this->id,
                        'status' => $this->status,
                        'superadmin' => $this->superadmin,
                        'created_at' => $this->created_at,
                        'updated_at' => $this->updated_at,
                        'email_confirmed' => $this->email_confirmed
                ]);
        
        $query->andFilterWhere([
                'like',
                'username',
                $this->username
        ])
            ->andFilterWhere([
                'like',
                'auth_key',
                $this->auth_key
        ])
            ->andFilterWhere([
                'like',
                'password_hash',
                $this->password_hash
        ])
            ->andFilterWhere(
                [
                        'like',
                        'confirmation_token',
                        $this->confirmation_token
                ])
            ->andFilterWhere(
                [
                        'like',
                        'registration_ip',
                        $this->registration_ip
                ])
            ->andFilterWhere([
                'like',
                'bind_to_ip',
                $this->bind_to_ip
        ])
            ->andFilterWhere([
                'like',
                'email',
                $this->email
        ]);
        
        return $dataProvider;
    }

    /**
     * Add query filter to select only main-user, no technical users
     *
     * @param ActiveQuery $query            
     */
    public static function mainUsersOnly(&$query)
    {
        $query->leftJoin('{{%auth_assignment}}', '{{%user}}.id = {{%auth_assignment}}.user_id')->andFilterWhere(
                [
                        '{{%auth_assignment}}.item_name' => UtilAuthorization::ROLE_USER
                ]);
    }

    /**
     *
     * @param integer $user_id            
     * @return \yii\data\ActiveDataProvider
     */
    public static function searchUserIdsInActiveInstance($user_id)
    {
        $active_instance_id = \Yii::$app->session->get(ConstantsGeneral::ACTIVE_INSTANCE_ID);
        
        $query = UserProfile::find();
        
        // static::mainUsersOnly($query);
        
        $dataProvider = new ActiveDataProvider([
                'query' => $query
        ]);
        
        $query->select('{{%user_profile}}.user_id')
            ->leftJoin('{{%instance_has_user}}', '{{%instance_has_user}}.user_id = {{%user_profile}}.user_id')
            ->andWhere('{{%user_profile}}.user_id=:user_id', [
                ':user_id' => $user_id
        ])
            ->andWhere('{{%instance_has_user}}.instance_id=:active_instance_id', 
                [
                        ':active_instance_id' => $active_instance_id
                ]);
        
        return $dataProvider;
    }

    /**
     *
     * @return \yii\data\ActiveDataProvider
     */
    public function searchAllUsersWithSales($params)
    {
        $query = $this->search($params)->query;
        $this->mainUsersOnly($query);
        
        $dataProvider = new ActiveDataProvider([
                'query' => $query
        ]);
        
        // $dataProvider = new ActiveDataProvider([
        // 'query' => $query
        // ]);
        
        // to avoid ambiguous names for sort, the attribute "name" should be
        // converted to "{{%user}}.name"
        // $dataProvider->sort->attributes["user_name"]["asc"] = [
        // "{{%user_profile}}.name" => SORT_ASC
        // ];
        
        $query->joinwith('userProfile')
            ->leftJoin('{{%sale}}', '{{%sale}}.user_id = {{%user}}.id')
            ->addSelect([
                'user_name' => '{{%user_profile}}.name'
        ])
            ->addSelect('id')
            ->addSelect([
                'used_user_id' => '{{%user_profile}}.user_id'
        ])
            ->addSelect([
                'nick_name' => '{{%user_profile}}.nick_name'
        ])
            ->addSelect([
                'name_extension' => '{{%user_profile}}.name_extension'
        ])
            ->addSelect(
                [
                        'last_event_date_utc' => EventSearch::find()->select('date_utc')
                            ->limit(1)
                            ->addOrderBy('{{%event}}.date_utc DESC')
                            ->andWhere(
                                [
                                        'event_id' => SaleSearch::find()->distinct()
                                            ->addSelect('event_id')
                                            ->andWhere('user_id=used_user_id')
                                ])
                ])
            ->addSelect(
                [
                        'last_event_name' => EventSearch::find()->select('name')
                            ->limit(1)
                            ->addOrderBy('{{%event}}.date_utc DESC')
                            ->andWhere(
                                [
                                        'event_id' => SaleSearch::find()->distinct()
                                            ->addSelect('event_id')
                                            ->andWhere('user_id=used_user_id')
                                ])
                ])
            ->addSelect([
                'last_login_at' => '{{%user_profile}}.last_login_at'
        ])
            ->addSelect(
                [
                        // Returns the first non-NULL value in the list<br>
                        // SELECT COALESCE(NULL,1); -> 1
                        'total' => 'COALESCE(SUM({{%sale}}.price_total),0)'
                ])
            ->addGroupBy('{{%user}}.id');
        // Debug::dump($query->createCommand()->getRawSql());
        // Debug::dump($query->createCommand()->getRawSql());
        
        return $dataProvider;
    }

    /**
     *
     * Method returns a query for users with an account value not equals to
     * zero.
     *
     * @return \yii\data\ActiveDataProvider
     */
    public function searchAllUsersWithSalesAndAccountNotEqualsZero($params)
    {
        $query = UserSearch::searchAllUsersWithSales($params)->query;
        
        $dataProvider = new ActiveDataProvider([
                'query' => $query
        ]);
        
        $query->having('total <> 0');
        
        return $dataProvider;
    }

    /**
     * Method returns a query for users with an account value equals zero.
     *
     * @return \yii\data\ActiveDataProvider
     */
    public function searchAllUsersWithSalesAndAccountEqualsZero($params)
    {
        $query = UserSearch::searchAllUsersWithSales($params)->query;
        
        $dataProvider = new ActiveDataProvider([
                'query' => $query
        ]);
        
        $query->having('total = 0');
        
        return $dataProvider;
    }

    /**
     * Method returns a user enriched with profile information.
     *
     * @return \yii\data\ActiveDataProvider
     */
    public function search_user_with_profile_data($params)
    {
        $query = UserSearch::search($params)->query;
        
        $dataProvider = new ActiveDataProvider([
                'query' => $query
        ]);
        
        $query->having('total = 0');
        
        return $dataProvider;
    }
}
