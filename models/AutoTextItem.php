<?php
namespace app\models;
use Yii;

/**
 * This is the model class for table "{{%auto_text_item}}".
 *
 * @property integer $id
 * @property string $name
 * @property integer $item_type
 *
 * @property AutoTextItemChain[] $autoTextItemChains
 * @property AutoTextItemChain[] $autoTextItemChains0
 * @property AutoTextSentences[] $autoTextSentences
 */
class AutoTextItem extends \yii\db\ActiveRecord
{

    const TYPE_MESSAGE = 1;

    const TYPE_SENTENCE = 2;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%auto_text_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [
                        [
                                'name'
                        ],
                        'required'
                ],
                [
                        [
                                'item_type'
                        ],
                        'integer'
                ],
                [
                        [
                                'name'
                        ],
                        'string',
                        'max' => 64
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
                'name' => Yii::t('app', 'Name'),
                'item_type' => Yii::t('app', 'Item Type')
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutoTextItemChains()
    {
        return $this->hasMany(AutoTextItemChain::className(), [
                'item_id' => 'id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutoTextItemChains0()
    {
        return $this->hasMany(AutoTextItemChain::className(), [
                'message_id' => 'id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutoTextSentences()
    {
        return $this->hasMany(AutoTextSentences::className(), [
                'item_id' => 'id'
        ]);
    }
}
