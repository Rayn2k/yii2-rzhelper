<?php
namespace rayn2k\rzhelper;
use Yii;
use rayn2k\rzhelper\assets\ImagePickerAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;

/**
 * utility class for Dropdown Selects
 *
 * @author RZ
 */
class UtilSelect
{

    public static function getBooleanNames()
    {
        // build assoc array for dropdownlist
        $assocArray = array();
        $assocArray['0'] = Yii::t('app', 'false');
        $assocArray['1'] = Yii::t('app', 'true');
        
        return $assocArray;
    }

    public static function getYesNoNames()
    {
        // build assoc array for dropdownlist
        $assocArray = array();
        $assocArray['0'] = Yii::t('app', 'no');
        $assocArray['1'] = Yii::t('app', 'yes');
        
        return $assocArray;
    }

    public static function getPictureSelect($view, $model, $pictures, $attribute, $dropdownlist_id, $preselected_value, $classes)
    {
        
        // add assets, e.g. with JS files to this view
        ImagePickerAsset::register($view);
        
        $js = <<< JS
        
JS;
        
        $view->registerJs($js);
        $view->registerJs("$('#" . $dropdownlist_id . "').imagepicker();", View::POS_READY);
        
        // set preselected value and sync with plugin afterwards
        $view->registerJs("$('#" . $dropdownlist_id . "').val('" . $preselected_value . "');", View::POS_READY);
        $view->registerJs("$('#" . $dropdownlist_id . "').data('picker').sync_picker_with_select();", View::POS_READY);
        
        // create picture map
        $picture_map = ArrayHelper::map($pictures, 'picture_id', 'file_name');
        
        // create options
        $options = array();
        foreach ($pictures as $picture) {
            /* @var $picture app\models\Picture */
            $options[$picture->picture_id] = [
                    'data-img-src' => $picture->getImagePath(),
                    'data-img-class' => $classes
            ];
        }
        
        // print the dropdown list
        echo Html::activeDropDownList($model, $attribute, $picture_map,
                [
                        'id' => $dropdownlist_id,
                        'options' => $options
                ]);
    }
}

?>