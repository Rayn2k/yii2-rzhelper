<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AutoTextSentences;

/**
 * AutoTextSentencesSearch represents the model behind the search form about `app\models\AutoTextSentences`.
 */
class AutoTextSentencesSearch extends AutoTextSentences
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
                                'item_id'
                        ],
                        'integer'
                ],
                [
                        [
                                'sentence'
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
        $query = AutoTextSentences::find();
        
        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
                'query' => $query
        ]);
        
        $this->load($params);
        
        if (! $this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        // grid filtering conditions
        $query->andFilterWhere([
                'id' => $this->id,
                'item_id' => $this->item_id
        ]);
        
        $query->andFilterWhere([
                'like',
                'sentence',
                $this->sentence
        ]);
        
        return $dataProvider;
    }

    public function searchRandomSentence($auto_text_item_id)
    {
        $query = AutoTextSentences::find();
        
        // grid filtering conditions
        $query->andFilterWhere([
                'item_id' => $auto_text_item_id
        ]);
        
        $query->addOrderBy('RAND()');
        
        return $query->limit(1)->one();
    }
}
