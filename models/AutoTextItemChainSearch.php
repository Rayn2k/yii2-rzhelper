<?php
namespace app\models;
use Yii;
use rayn2k\rzhelper\Debug;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AutoTextItemChain;

/**
 * AutoTextItemChainSearch represents the model behind the search form about `app\models\AutoTextItemChain`.
 */
class AutoTextItemChainSearch extends AutoTextItemChain
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
                                'message_id',
                                'item_id',
                                'order'
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
        $query = AutoTextItemChain::find();
        
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
        $query->andFilterWhere(
                [
                        'id' => $this->id,
                        'message_id' => $this->message_id,
                        'item_id' => $this->item_id,
                        'order' => $this->order
                ]);
        
        return $dataProvider;
    }

    public function searchMessageChain($message_id)
    {
        $query = AutoTextItemChain::find();
        
        // grid filtering conditions
        $query->andFilterWhere([
                'message_id' => $message_id
        ]);
        
        $query->addOrderBy('{{%auto_text_item_chain}}.order ASC');
        
        return $query->all();
    }

    public function getAutoText($message_name)
    {
        $message_auto_text_item = AutoTextItem::find()->andFilterWhere([
                'name' => $message_name
        ])->one();
        
        $auto_text_item_chain = $this->searchMessageChain($message_auto_text_item->id);
        
        $auto_text = "";
        
        foreach ($auto_text_item_chain as $auto_text_item_chain_element) {
            
            // Debug::dump($auto_text_item_chain_element);
            
            $auto_text_sentence = AutoTextSentences::find()->andFilterWhere(
                    [
                            'item_id' => $auto_text_item_chain_element->item_id
                    ])
                ->addOrderBy('RAND()')
                ->limit(1)
                ->one();
            
            $auto_text .= $auto_text_sentence->sentence;
        }
        
        return $auto_text;
    }
}
