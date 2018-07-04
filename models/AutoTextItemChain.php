<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%auto_text_item_chain}}".
 *
 * @property integer $id
 * @property integer $message_id
 * @property integer $item_id
 * @property integer $order
 *
 * @property AutoTextItem $item
 * @property AutoTextItem $message
 */
class AutoTextItemChain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auto_text_item_chain}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['message_id', 'item_id', 'order'], 'integer'],
            [['item_id'], 'required'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => AutoTextItem::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['message_id'], 'exist', 'skipOnError' => true, 'targetClass' => AutoTextItem::className(), 'targetAttribute' => ['message_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'message_id' => Yii::t('app', 'Message ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(AutoTextItem::className(), ['id' => 'item_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMessage()
    {
        return $this->hasOne(AutoTextItem::className(), ['id' => 'message_id']);
    }
}
