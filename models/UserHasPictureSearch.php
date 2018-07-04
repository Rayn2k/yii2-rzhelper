<?php
namespace app\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserHasPicture;

/**
 * UserHasPictureSearch represents the model behind the search form about `app\models\UserHasPicture`.
 */
class UserHasPictureSearch extends UserHasPicture
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
                                'user_id',
                                'picture_id',
                                'chosen_individual',
                                'chosen_general'
                        ],
                        'integer'
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
        $query = UserHasPicture::find();
        
        $dataProvider = new ActiveDataProvider([
                'query' => $query
        ]);
        
        $this->load($params);
        
        if (! $this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        $query->andFilterWhere(
                [
                        'id' => $this->id,
                        'user_id' => $this->user_id,
                        'picture_id' => $this->picture_id,
                        'chosen_individual' => $this->chosen_individual,
                        'chosen_general' => $this->chosen_general
                ]);
        
        return $dataProvider;
    }
}
