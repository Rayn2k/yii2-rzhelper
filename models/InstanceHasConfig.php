<?php
namespace app\models;
use Yii;
use rayn2k\rzhelper\ConstantsGeneral;
use rayn2k\rzhelper\Debug;

/**
 * This is the model class for table "{{%instance_has_config}}".
 *
 * @property integer $id
 * @property integer $instance_id
 * @property integer $config_key
 * @property string $value
 *
 * @property Instance $instance
 * @property Configs $config
 */
class InstanceHasConfig extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%instance_has_config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [
                        [
                                'instance_id',
                                'config_key'
                        ],
                        'required'
                ],
                [
                        [
                                'instance_id'
                        ],
                        'integer'
                ],
                [
                        [
                                'value',
                                'config_key'
                        ],
                        'string'
                ]
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), [
                'value'
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
                'id' => Yii::t('app', 'ID'),
                'instance_id' => Yii::t('app', 'Instance ID'),
                'config_key' => Yii::t('app', 'Config Key'),
                'value' => Yii::t('app', 'Value')
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstance()
    {
        return $this->hasOne(Instance::className(), [
                'instance_id' => 'instance_id'
        ]);
    }

    /**
     *
     * @return
     *
     */
    public function getConfig()
    {
        return $this->hasOne(Config::className(), [
                'config_key' => 'config_key'
        ]);
    }
}
