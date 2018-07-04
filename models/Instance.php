<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%instance}}".
 *
 * @property integer $instance_id
 * @property string $description
 * @property string $description_short
 */
class Instance extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%instance}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'description_short'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'instance_id' => Yii::t('app', 'Instance ID'),
            'description' => Yii::t('app', 'Description'),
            'description_short' => Yii::t('app', 'Description Short'),
        ];
    }
}
