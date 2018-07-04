<?php
namespace app\models;
use Yii;
use rayn2k\rzhelper\UtilString;

/**
 * This is the model class for table "{{%user_profile}}".
 *
 * @property integer $user_id
 * @property string $name
 * @property string $name_extension
 * @property string $nick_name
 * @property string $name_for_messages
 * @property integer $send_mail
 * @property string $phone
 * @property integer $send_phone
 * @property integer $login_fails
 * @property string $last_login_at
 */
class UserProfile extends \yii\db\ActiveRecord
{

    const default_picture_name = "_user_default";

    const default_picture_format = "png";

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_profile}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [
                        [
                                'user_id'
                        ],
                        'required'
                ],
                [
                        [
                                'user_id',
                                'send_mail',
                                'send_phone',
                                'login_fails'
                        ],
                        'integer'
                ],
                [
                        [
                                'name',
                                'name_extension',
                                'nick_name',
                                'name_for_messages',
                                'phone',
                                'username',
                                'email',
                                'password',
                                'repeat_password'
                        ],
                        'string'
                ],
                [
                        [
                                'last_login_at'
                        ],
                        'safe'
                ],
                [
                        [
                                'user_id'
                        ],
                        'exist',
                        'skipOnError' => true,
                        'targetClass' => User::className(),
                        'targetAttribute' => [
                                'user_id' => 'id'
                        ]
                ],
                [
                        // set "send_mail" and "send_phone" to be 0 if it is empty
                        [
                                'send_mail',
                                'send_phone'
                        ],
                        'default',
                        'value' => 0
                ]
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(),
                [
                        'uniqid',
                        'username',
                        'email',
                        'auth_key',
                        'confirmation_token',
                        'password_hash',
                        'status',
                        'created_at',
                        'updated_at',
                        'registration_ip',
                        'bind_to_ip',
                        'email_confirmed',
                        'password',
                        'repeat_password'
                ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return array_merge((new User())->attributeLabels(),
                [
                        'user_id' => Yii::t('app', 'User ID'),
                        'name' => Yii::t('app', 'Name'),
                        'name_extension' => Yii::t('app', 'Name Extension'),
                        'nick_name' => Yii::t('app', 'Nick Name'),
                        'name_for_messages' => Yii::t('app', 'Name For Messages'),
                        'send_mail' => Yii::t('app', 'Send Mail'),
                        'phone' => Yii::t('app', 'Phone'),
                        'send_phone' => Yii::t('app', 'Send Phone'),
                        'login_fails' => Yii::t('app', 'Login Fails'),
                        'last_login_at' => Yii::t('app', 'Last Login At')
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

    /**
     *
     * @return PictureType
     */
    public static function getPictureType()
    {
        return PictureType::find()->andWhere([
                'class_name' => 'User'
        ])->one();
    }

    /**
     * Get the default picture for this class
     *
     * @return Picture
     */
    public static function getDefaultPicture()
    {
        return Picture::find()->andWhere(
                [
                        'format' => static::default_picture_format,
                        'file_name' => static::default_picture_name
                ])->one();
    }

    /**
     * Get the first picture of the user, which is marked with 'true' in the
     * field 'chosen_general' in the {{%user_has_picture}}
     * table.
     * Fallback is default picture, if no picture is available or marked with
     * 'true'.
     *
     * @return \app\models\Picture
     */
    public function getGeneralChosenPicture()
    {
        // check, whether the user has a general chosen picture
        $userHasPicture = UserHasPicture::find()->andWhere(
                [
                        'user_id' => $this->user_id,
                        'chosen_general' => 1
                ])->one();
        
        // in case no general picture is available, use default picture
        if (is_null($userHasPicture)) {
            return static::getDefaultPicture();
        }
        
        return Picture::findOne($userHasPicture->picture_id);
    }

    /**
     * Get the first picture of the user, which is marked with 'true' in the
     * field 'chosen_individual' in the
     * {{%user_has_picture}} table.
     * Fallback is default picture, if no picture is available or marked with
     * 'true'.
     *
     * @return \app\models\Picture
     */
    public function getIndividualChosenPicture()
    { // check, whether the user has an individual chosen picture
        $userHasPicture = UserHasPicture::find()->andWhere(
                [
                        'user_id' => $this->user_id,
                        'chosen_individual' => 1
                ])->one();
        
        // in case no individual picture is available, use default picture
        if (is_null($userHasPicture)) {
            return static::getDefaultPicture();
        }
        
        return Picture::findOne($userHasPicture->picture_id);
    }

    /**
     * Get the name to display including nickname, if available
     *
     * @return string
     */
    public function getDisplayName()
    {
        $display_name = $this->name;
        
        if (! UtilString::is_empty($this->nick_name)) {
            $display_name = $display_name . " (" . $this->nick_name . ")";
        }
        
        return $display_name;
    }

    /**
     * Get the name for messages.
     * If a special one is available, use them, otherwise use usual name.
     *
     * @return string
     */
    public function getNameForMessages()
    {
        $name_for_messages = "";
        
        if (! UtilString::is_empty($this->name_for_messages)) {
            $name_for_messages = $this->name_for_messages;
        } else {
            $name_for_messages = $this->name;
        }
        
        return $name_for_messages;
    }
}
