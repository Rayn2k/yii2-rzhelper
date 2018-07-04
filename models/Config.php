<?php
namespace app\models;
use Yii;
use rayn2k\rzhelper\ConstantsGeneral;
use rayn2k\rzhelper\Debug;
use rayn2k\rzhelper\UtilString;

/**
 * This is the model class for table "{{%config}}".
 *
 * @property string $config_key
 * @property string $description
 * @property string $possible_values
 * @property string $default
 *
 * @property InstanceHasConfig[] $instanceHasConfig
 */
class Config extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%config}}';
    }

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
                        'string'
                ],
                [
                        [
                                'config_key',
                                'description',
                                'default'
                        ],
                        'required'
                ],
                [
                        [
                                'config_key'
                        ],
                        'unique'
                ],
                [
                        // set "possible_values" to be null if it is empty
                        'possible_values',
                        'default',
                        'value' => null
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
                'config_key' => Yii::t('app', 'Config Key'),
                'description' => Yii::t('app', 'Description'),
                'possible_values' => Yii::t('app', 'Possible Values (comma-separated)'),
                'value' => Yii::t('app', 'Actual Value'),
                'default' => Yii::t('app', 'Default Value')
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInstanceHasConfig()
    {
        return $this->hasMany(InstanceHasConfig::className(), [
                'config_key' => 'config_key'
        ]);
    }

    /**
     * get the value for a config key in the active instance
     */
    public static function getConfigValueInActiveInstance($key, $use_fallback = true)
    {
        // use active instance
        $instance_id = \Yii::$app->session->get(ConstantsGeneral::ACTIVE_INSTANCE_ID);
        
        // get id for key
        $config = Config::findOne([
                'config_key' => $key
        ]);
        
        if (is_null($config)) {
            return null;
        }
        
        // get assignemnt
        $instance_has_config = InstanceHasConfig::findOne(
                [
                        'config_key' => $config->config_key,
                        'instance_id' => $instance_id
                ]);
        
        if (is_null($instance_has_config)) {
            return $use_fallback ? static::getDefaultValue($key) : null;
        }
        
        return $instance_has_config->value;
    }

    /**
     * get the default value for a config key
     */
    public static function getDefaultValue($key)
    {
        
        // get id for key
        $config = Config::findOne([
                'config_key' => $key
        ]);
        
        if (is_null($config)) {
            return null;
        }
        
        return $config->default;
    }

    /**
     * Determine, whether the config entry has possible values.
     * Possible values should be stored as comma separated values in the database.
     *
     * @return boolean
     */
    public function hasPossibleValues()
    {
        // if null, no values are available
        if (is_null($this->possible_values)) {
            return false;
        }
        
        // check, whether possible values are correct, comma-separated values
        $possible_values = UtilString::explode($this->possible_values, ",");
        
        return count($possible_values) > 0 ? true : false;
    }

    /**
     * Get a string array with all possible values or null, if no valid values are available.
     *
     * @return NULL|string[]
     */
    public function getPossibleValues()
    {
        if (! $this->possible_values) {
            return null;
        }
        
        // to handle correctly in a listbox widget, we need an assoc array
        $possible_values = array();
        foreach (UtilString::explode($this->possible_values, ",") as $value) {
            $possible_values[$value] = $value;
        }
        return $possible_values;
    }
}
