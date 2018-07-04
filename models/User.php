<?php
namespace app\models;
use Yii;
use rayn2k\rzhelper\Debug;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $confirmation_token
 * @property integer $status
 * @property integer $superadmin
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $registration_ip
 * @property string $bind_to_ip
 * @property string $email
 * @property integer $email_confirmed
 */
class User extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
                [
                        [
                                'username',
                                'auth_key',
                                'password_hash',
                                'status',
                                'created_at',
                                'updated_at'
                        ],
                        'required'
                ],
                [
                        [
                                'status',
                                'superadmin',
                                'created_at',
                                'updated_at',
                                'email_confirmed'
                        ],
                        'integer'
                ],
                [
                        [
                                'username',
                                'password_hash',
                                'confirmation_token',
                                'bind_to_ip',
                                'phone'
                        ],
                        'string',
                        'max' => 255
                ],
                [
                        [
                                'auth_key'
                        ],
                        'string',
                        'max' => 32
                ],
                [
                        [
                                'registration_ip'
                        ],
                        'string',
                        'max' => 15
                ],
                [
                        [
                                'email'
                        ],
                        'string',
                        'max' => 128
                ]
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(),
                [
                        'used_user_id',
                        'user_name',
                        'nick_name',
                        'name_extension',
                        'last_event_date_utc',
                        'last_event_name',
                        'last_login_at',
                        'total',
                        'phone'
                ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
                'id' => Yii::t('app', 'ID'),
                'username' => Yii::t('app', 'Username'),
                'auth_key' => Yii::t('app', 'Auth Key'),
                'password_hash' => Yii::t('app', 'Password Hash'),
                'confirmation_token' => Yii::t('app', 'Confirmation Token'),
                'status' => Yii::t('app', 'Status'),
                'superadmin' => Yii::t('app', 'Superadmin'),
                'created_at' => Yii::t('app', 'Created At'),
                'updated_at' => Yii::t('app', 'Updated At'),
                'registration_ip' => Yii::t('app', 'Registration Ip'),
                'bind_to_ip' => Yii::t('app', 'Bind To Ip'),
                'email' => Yii::t('app', 'Email'),
                'email_confirmed' => Yii::t('app', 'Email Confirmed'),
                'last_event_date_utc' => Yii::t('app', 'Last Event Date UTC'),
                'last_login_at' => Yii::t('app', 'Last Login At'),
                'total' => Yii::t('app', 'Account Actual')
        ];
    }

    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(UserProfile::className(), [
                'user_id' => 'id'
        ]);
    }

    /**
     * Wrapper for user rights management to retrieve the current user
     *
     * @return NULL|\app\models\User
     */
    public static function getLoggedInUser()
    {
        $user = \webvimark\modules\UserManagement\models\User::getCurrentUser();
        if (! isset($user) or is_null($user)) {
            return null;
        }
        return User::findOne($user->id);
    }

    /**
     * Wrapper for user rights management to determine, whether the current user
     * has a role.
     *
     * @param String $role
     * @return boolean
     */
    public static function hasRole($role)
    {
        if (YII_DEBUG) {
            return true;
        }
        
        return \webvimark\modules\UserManagement\models\User::hasRole($role);
    }

    /**
     * Wrapper for user rights management to determine, whether the current user
     * has a permission.
     *
     * @param String $permission
     * @return boolean
     */
    public static function hasPermission($permission, $allow_everything_in_debug = true)
    {
        if (YII_DEBUG && $allow_everything_in_debug) {
            return true;
        }
        
        return \webvimark\modules\UserManagement\models\User::hasPermission($permission);
    }

    /**
     * Wrapper for user rights management to determine, whether the current user
     * can access a route.
     *
     * @param String $route
     * @return boolean
     */
    public static function canRoute($route)
    {
        if (YII_DEBUG) {
            return true;
        }
        return \webvimark\modules\UserManagement\models\User::canRoute($route);
    }

    /**
     * Change the password of this user
     */
    public static function changePassword($id, $password, $repeat_password)
    {
        // if user has not the permission to access other user data, show always only himself
        if (User::hasPermission("access_other_user_data", false)) {
            $user_id = $id;
        } else {
            $user_id = Yii::$app->user->id;
        }
        
        $model = \webvimark\modules\UserManagement\models\User::findOne($user_id);
        
        if (! $model) {
            throw new NotFoundHttpException('User not found');
        }
        
        $model->scenario = 'changePassword';
        
        if (! $password || $password == "") {
            throw new NotFoundHttpException("Parameter 'password' not set");
        }
        
        if (! $repeat_password || $repeat_password == "") {
            throw new NotFoundHttpException("Parameter 'post_repeat_password' not set");
        }
        
        $model->password = $password;
        $model->repeat_password = $repeat_password;
        
        if ($model->save()) {
            return true;
        } else {
            return false;
        }
    }
}
