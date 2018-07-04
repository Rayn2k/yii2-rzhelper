<?php
namespace app\models;
use Yii;

/**
 * This is the model class for table "{{%user_has_picture}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $picture_id
 * @property integer $chosen_individual
 * @property integer $chosen_general
 *
 * @property User $user
 * @property Picture $picture
 */
class UserHasPicture extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_has_picture}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [
                        [
                                'user_id',
                                'picture_id'
                        ],
                        'required'
                ],
                [
                        [
                                'user_id',
                                'picture_id',
                                'chosen_individual',
                                'chosen_general'
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
                'user_id' => Yii::t('app', 'User ID'),
                'picture_id' => Yii::t('app', 'Picture ID'),
                'chosen_individual' => Yii::t('app', 'Chosen Individual'),
                'chosen_general' => Yii::t('app', 'Chosen General')
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), [
                'user_id' => 'user_id'
        ]);
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPicture()
    {
        return $this->hasOne(Picture::className(), [
                'picture_id' => 'picture_id'
        ]);
    }

    public function set_to_chosen_individual()
    {
        // reset all other occurences of the same pair user_id/picture_id
        $assigments = UserHasPicture::find()->andWhere('user_id=:user_id', 
                [
                        ':user_id' => $this->user_id
                ])->all();
        
        foreach ($assigments as $assigment) {
            $assigment->chosen_individual = 0;
            $assigment->update();
        }
        
        $this->chosen_individual = 1;
        $this->update();
    }

    public function set_to_chosen_general()
    {
        // reset all other occurences of the same pair user_id/picture_id
        $assigments = UserHasPicture::find()->andWhere('user_id=:user_id', 
                [
                        ':user_id' => $this->user_id
                ])->all();
        
        foreach ($assigments as $assigment) {
            $assigment->chosen_general = 0;
            $assigment->update();
        }
        
        $this->chosen_general = 1;
        $this->update();
    }
}
