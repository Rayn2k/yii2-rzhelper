<?php
namespace app\models;
use Yii;

/**
 * This is the model class for table "{{%instance_has_user}}".
 *
 * @property integer $id
 * @property integer $instance_id
 * @property integer $user_id
 *
 * @property Instance $instance
 * @property Users $user
 */
class InstanceHasUser extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%instance_has_user}}';
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
                                'user_id'
                        ],
                        'required'
                ],
                [
                        [
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
    public function attributeLabels()
    {
        return [
                'id' => Yii::t('app', 'ID'),
                'instance_id' => Yii::t('app', 'Instance ID'),
                'user_id' => Yii::t('app', 'User ID')
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
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), [
                'id' => 'user_id'
        ]);
    }
}
