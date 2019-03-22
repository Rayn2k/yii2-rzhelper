<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace rayn2k\rzhelper\assets;

class ImagePickerAsset extends AssetBundle
{

    public $basePath = '@bower/image-picker';

    public $css = [
            'image-picker.css'
    ];

    public $js = [
            'image-picker.js'
    ];

    public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
            'yii\web\JqueryAsset',
            'yii\jui\JuiAsset'
    ];
}
