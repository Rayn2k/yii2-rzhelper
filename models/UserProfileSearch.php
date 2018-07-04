<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserProfile;
use rayn2k\rzhelper\ConstantsGeneral;
use rayn2k\rzhelper\Debug;

/**
 * UserProfileSearch represents the model behind the search form about
 * `app\models\UserProfile`.
 */
class UserProfileSearch extends UserProfile
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [
                        [
                                'user_id',
                                'send_mail',
                                'send_phone',
                                'login_fails'
                        ],
                        'integer'
                ],
                [
                        [
                                'name',
                                'name_extension',
                                'nick_name',
                                'name_for_messages',
                                'phone',
                                'last_login_at',
                                'username',
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
        $query = UserProfile::find()->joinWith('user');
        
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
                        'user_id' => $this->user_id,
                        'send_mail' => $this->send_mail,
                        'send_phone' => $this->send_phone,
                        'login_fails' => $this->login_fails,
                        'last_login_at' => $this->last_login_at
                ]);
        
        $query->andFilterWhere(
                [
                        'like',
                        'name_extension',
                        $this->name_extension
                ])
            ->andFilterWhere([
                'like',
                'nick_name',
                $this->nick_name
        ])
            ->andFilterWhere(
                [
                        'like',
                        'name_for_messages',
                        $this->name_for_messages
                ])
            ->andFilterWhere([
                'like',
                'phone',
                $this->phone
        ]);
        
        return $dataProvider;
    }

    /**
     * TODO
     *
     * @return \yii\data\ActiveDataProvider
     */
    public function searchUserName($searchText)
    {
        $query = UserProfile::find();
        
        $dataProvider = new ActiveDataProvider([
                'query' => $query
        ]);
        
        $query->addSelect('name')
            ->addSelect('user_id')
            ->addSelect('nick_name')
            ->addSelect('name_extension')
            ->orderBy('name ASC');
        
        if (! is_null($searchText) && $searchText != "") {
            // escape apostrophs to avoid sql injection
            $searchText = addslashes($searchText);
            $query->andFilterWhere(
                    [
                            'or',
                            [
                                    'like',
                                    'nick_name',
                                    $searchText
                            ],
                            [
                                    'like',
                                    'name',
                                    $searchText
                            ],
                            [
                                    'like',
                                    'name_extension',
                                    $searchText
                            ]
                    ]);
        }
        
        return $dataProvider;
    }
}
