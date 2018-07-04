<?php
namespace app\models;
use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%picture}}".
 *
 * @property integer $picture_id
 * @property integer $picture_type_id
 * @property string $format
 * @property string $file_name
 *
 * @property Event[] $events
 * @property Item[] $items
 * @property PictureType $PictureType
 * @property UserHasPicture[] $userHasPictures
 */
class Picture extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%picture}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [
                        [
                                'picture_type_id'
                        ],
                        'required'
                ],
                [
                        [
                                'picture_type_id'
                        ],
                        'integer'
                ],
                [
                        [
                                'format',
                                'file_name'
                        ],
                        'string'
                ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
                'picture_id' => Yii::t('app', 'Picture ID'),
                'picture_type_id' => Yii::t('app', 'Picture Type ID'),
                'format' => Yii::t('app', 'Format'),
                'file_name' => Yii::t('app', 'File Name')
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Event::className(), [
                'picture_id' => 'picture_id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), [
                'picture_id' => 'picture_id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPictureType()
    {
        return $this->hasOne(PictureType::className(), [
                'picture_type_id' => 'picture_type_id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserHasPictures()
    {
        return $this->hasMany(UserHasPicture::className(), [
                'picture_id' => 'picture_id'
        ]);
    }

    /**
     * Build an associative array for dropdownlists in format [$id] = $name
     *
     * @return string[]
     */
    public static function getAllNames()
    {
        // build assoc array for dropdownlist
        $assocArray = array();
        foreach (Picture::find()->select("picture_id,file_name,format")->all() as $picture) {
            /* @var $picture Picture */
            // format of name
            $arrayName = $picture->file_name . "." . $picture->format;
            $assocArray[$picture->picture_id] = $arrayName;
        }
        return $assocArray;
    }

    /**
     * Get the full path of this picture
     *
     * @return string
     */
    public function getImagePath()
    {
        $pictureType = PictureType::findOne($this->picture_type_id);
        $url = \Yii::$app->request->BaseUrl . $pictureType->folder . $this->file_name . "." . $this->format;
        
        return $url;
    }

    /**
     * Get the picture of an item.
     * In case no picture is available, return default picture.
     *
     * @return string
     */
    public static function getItemImage($id)
    {
        $picture = Picture::findOne($id);
        
        if (! isset($picture)) {
            $picture = Item::getDefaultPicture();
        }
        
        return $picture;
    }
}
