<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */
namespace app\assets;
use yii\web\AssetBundle;

class ImagePickerAsset extends AssetBundle
{

    public $basePath = '@rz-assets';

    public $css = [
            'image-picker/image-picker.css'
    ];

    public $js = [
            'image-picker/image-picker.js'
    ];

    public $depends = [
            'yii\web\YiiAsset',
            'yii\bootstrap\BootstrapAsset',
            'yii\web\JqueryAsset',
            'yii\jui\JuiAsset'
    ];
}
