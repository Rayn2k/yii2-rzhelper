<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%auto_text_sentences}}".
 *
 * @property integer $id
 * @property integer $item_id
 * @property string $sentence
 *
 * @property AutoTextItem $item
 */
class AutoTextSentences extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auto_text_sentences}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['item_id'], 'required'],
            [['item_id'], 'integer'],
            [['sentence'], 'string'],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => AutoTextItem::className(), 'targetAttribute' => ['item_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_id' => Yii::t('app', 'Item ID'),
            'sentence' => Yii::t('app', 'Sentence'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(AutoTextItem::className(), ['id' => 'item_id']);
    }
}
