<?php
namespace app\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InstanceHasConfig;
use rayn2k\rzhelper\Debug;
use rayn2k\rzhelper\ConstantsGeneral;

/**
 * InstanceHasConfigSearch represents the model behind the search form about
 * `app\models\InstancesHasConfig`.
 */
class InstanceHasConfigSearch extends InstanceHasConfig
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
                                'instance_id'
                        ],
                        'integer'
                ],
                [
                        [
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
        $query = InstanceHasConfig::find();
        
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
        
        $query->andFilterWhere(
                [
                        'id' => $this->id,
                        'instance_id' => $this->instance_id,
                        'config_key' => $this->config_key
                ]);
        
        $query->andFilterWhere([
                'like',
                'value',
                $this->value
        ]);
        
        return $dataProvider;
    }

    /**
     *
     * @param integer $instance_id            
     * @param string $config_key            
     * @return app\models\InstanceHasConfig
     */
    public function searchForInstanceIdAndConfigKey($instance_id, $config_key)
    {
        return InstanceHasConfig::find()->andFilterWhere(
                [
                        'instance_id' => $instance_id,
                        'config_key' => $config_key
                ])->one();
    }

    /**
     * Return the instance-has-config entry for a selected key.
     * If no entry is available in the database, create a new object with the
     * instance and config key parameter.
     *
     * @return app\models\InstanceHasConfig
     */
    public function findOrCreateConfigEntry($key)
    {
        $model = $this->searchForInstanceIdAndConfigKey(\Yii::$app->session->get(ConstantsGeneral::ACTIVE_INSTANCE_ID), $key);
        
        // if no entry is available, create one
        if (is_null($model)) {
            $model = new InstanceHasConfig();
            $model->instance_id = \Yii::$app->session->get(ConstantsGeneral::ACTIVE_INSTANCE_ID);
            $model->config_key = $key;
        }
        
        return $model;
    }
}
