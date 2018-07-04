<?php
namespace app\controllers;
use yii\web\Controller;

class AuthController extends Controller
{

    public $freeAccessActions = [];

    public $freeAccess;

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        // in DEBUG mode all sites are free to access
        if (defined('YII_FREE_ACCESS')) {
            $this->freeAccess = true;
        } else {
            $this->freeAccess = false;
        }
        return parent::beforeAction($action);
    }

    public function behaviors()
    {
        return [
                'ghost-access' => [
                        'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl'
                ]
        ];
    }
}
