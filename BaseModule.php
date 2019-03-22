<?php
namespace rzhelper\modules\base;

/**
 * base module definition class
 */
class BaseModule extends \yii\base\Module
{

    /**
     *
     * {@inheritdoc}
     */
    public $controllerNamespace = 'rzhelper\modules\base\controllers';

    /**
     *
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        
        // custom initialization code goes here
        $this->setAliases([
                '@rz-assets' => __DIR__ . '/src/assets'
        ]);
    }
}
