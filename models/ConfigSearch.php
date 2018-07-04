<?php
namespace app\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Config;
use rayn2k\rzhelper\ConstantsGeneral;
use rayn2k\rzhelper\UtilDate;

/**
 * ConfigSearch represents the model behind the search form about
 * `app\models\Config`.
 */
class ConfigSearch extends Config
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [
                        [
                                'config_key',
                                'description',
                                'possible_values',
                                'default',
                                'value'
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
        $query = Config::find();
        
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
        
        $query->andFilterWhere([
                'like',
                'config_key',
                $this->config_key
        ])
            ->andFilterWhere(
                [
                        'like',
                        'description',
                        $this->description
                ])
            ->andFilterWhere(
                [
                        'like',
                        'possible_values',
                        $this->possible_values
                ])
            ->andFilterWhere([
                'like',
                'default',
                $this->default
        ])
            ->andFilterWhere([
                'like',
                'value',
                $this->value
        ]);
        
        return $dataProvider;
    }

    /**
     *
     * @return \yii\data\ActiveDataProvider
     */
    public function searchConfigInInstance($params, $instance_id)
    {
        $dataProvider = self::search($params);
        
        $query = $dataProvider->query;
        $query->leftJoin('{{%instance_has_config}}', 
                '{{%instance_has_config}}.config_key = {{%config}}.config_key AND {{%instance_has_config}}.instance_id=:active_instance_id', 
                [
                        ':active_instance_id' => $instance_id
                ])
            ->addSelect('{{%config}}.config_key')
            ->addSelect('{{%config}}.description')
            ->addSelect('{{%config}}.possible_values')
            ->addSelect('{{%config}}.default')
            ->addSelect('{{%instance_has_config}}.value');
        
        return $dataProvider;
    }
}
