<?php
namespace rayn2k\rzhelper;
use Yii;

class Startup extends \yii\base\Component
{

    public function init()
    {
        // check Session
        if (! \Yii::$app->session->has(ConstantsGeneral::ACTIVE_INSTANCE_ID)) {
            \Yii::$app->session->set(ConstantsGeneral::ACTIVE_INSTANCE_ID, Yii::$app->params[ConstantsGeneral::DEFAULT_INSTANCE_ID]);
        }
        parent::init();
    }
}