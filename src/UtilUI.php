<?php
namespace rayn2k\rzhelper;
use Yii;
use dosamigos\datepicker\DateRangePicker;
use trntv\yii\datetime\DateTimeWidget;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * utility class for UI Elements
 *
 * @author RZ
 */
class UtilUI
{

    public static function getDateTimePicker($form, $model, $attribute)
    {
        return $form->field($model, $attribute)->widget(DateTimeWidget::className(),
                [
                        'phpDatetimeFormat' => 'yyyy-MM-dd HH:mm:ss',
                        'momentDatetimeFormat' => 'YYYY-MM-DD HH:mm:ss',
                        'clientOptions' => [
                                'minDate' => new \yii\web\JsExpression('new Date("2015-01-01")'),
                                'allowInputToggle' => false,
                                'sideBySide' => true,
                                'locale' => 'de-DE',
                                'widgetPositioning' => [
                                        'horizontal' => 'auto',
                                        'vertical' => 'auto'
                                ]
                        ]
                ]);
    }

    /**
     *
     * @param ActiveForm $form
     * @param SalesDateSelectForm $model
     * @param string $attributeFrom
     * @param string $attributeTo
     */
    public static function getDateRangePicker($form, $model, $attributeFrom, $attributeTo)
    {
        return $form->field($model, $attributeFrom)
            ->label(false)
            ->widget(DateRangePicker::className(),
                [
                        'attributeTo' => $attributeTo,
                        'labelTo' => Yii::t('app', 'to'),
                        'form' => $form, // best for correct client validation
                        'language' => 'de',
                        'size' => 'sm',
                        'clientOptions' => [
                                'autoclose' => true,
                                'format' => 'dd.mm.yyyy'
                        ]
                ]);
    }

    public static function getBooleanSelectDropDown($form, $model, $attribute)
    {
        return $form->field($model, $attribute)->widget('dosamigos\formhelpers\Select',
                [
                        'items' => UtilSelect::getBooleanNames()
                ]);
    }

    public static function getYesNoSelectDropDown($form, $model, $attribute)
    {
        return $form->field($model, $attribute)->widget('dosamigos\formhelpers\Select',
                [
                        'items' => UtilSelect::getYesNoNames()
                ]);
    }

    public static function getButtonDiv($content)
    {
        return Html::tag('div', $content,
                [
                        'class' => [
                                'padding-5-px',
                                'float-left'
                        ]
                ]);
    }
}

?>