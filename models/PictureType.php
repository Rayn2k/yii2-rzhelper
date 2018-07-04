<?php
namespace app\models;
use Yii;
use rayn2k\rzhelper\UtilString;
use app\models\User;

/**
 * This is the model class for table "{{%picture_type}}".
 *
 * @property integer $picture_type_id
 * @property string $class_name
 * @property string $folder
 * @property integer $has_fixed_resolution
 * @property integer $width
 * @property integer $height
 * @property string $possible_formats
 * @property string $default_file_name
 * @property string $default_format
 *
 * @property Picture[] $pictures
 */
class PictureType extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%picture_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [
                        [
                                'class_name',
                                'folder',
                                'possible_formats',
                                'default_file_name',
                                'default_format'
                        ],
                        'string'
                ],
                [
                        [
                                'has_fixed_resolution',
                                'width',
                                'height'
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
                'picture_type_id' => Yii::t('app', 'Picture Type ID'),
                'class_name' => Yii::t('app', 'Class-Name'),
                'folder' => Yii::t('app', 'Folder'),
                'has_fixed_resolution' => Yii::t('app', 'Has Fixed Resolution'),
                'width' => Yii::t('app', 'Width'),
                'height' => Yii::t('app', 'Height'),
                'possible_formats' => Yii::t('app', 'Possible Formats'),
                'default_file_name' => Yii::t('app', 'Default File Name'),
                'default_format' => Yii::t('app', 'Default Format')
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPictures()
    {
        return $this->hasMany(Picture::className(), [
                'picture_type_id' => 'picture_type_id'
        ]);
    }

    /**
     *
     * @return PictureType
     */
    public static function getDefault()
    {
        return static::find()->one();
    }

    /**
     *
     * @return string[]
     */
    public static function getAllNames()
    {
        // build assoc array for dropdownlist
        $assocArray = array();
        foreach (PictureType::find()->select("picture_type_id,class_name")->all() as $PictureType) {
            $assocArray[$PictureType->picture_type_id] = Yii::t('app', $PictureType->class_name);
        }
        return $assocArray;
    }

    /**
     * Ist the picture type linked to class 'User'
     *
     * @return boolean
     */
    public function isTypeUser()
    {
        if (UtilString::equals_ignore_case($this->class_name, UtilString::basename(User::className()))) {
            return true;
        }
        return false;
    }
}
