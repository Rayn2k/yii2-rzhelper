<?php
namespace app\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InstanceHasUser;

/**
 * InstanceHasUserSearch represents the model behind the search form about `app\models\InstanceHasUser`.
 */
class InstanceHasUserSearch extends InstanceHasUser
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
                                'instance_id',
                                'user_id'
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
        $query = InstanceHasUser::find();
        
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
                        'instance_id' => $this->instance_id,
                        'user_id' => $this->user_id
                ]);
        
        return $dataProvider;
    }
}
