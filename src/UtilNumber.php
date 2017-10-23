<?php
namespace app\rzcomponents;
use yii\helpers\Html;

/**
 * helper class for all printing issues
 *
 * @author RZ
 */
class UtilNumber
{

    /**
     * get representation of a value with currency
     *
     * @param $value $id            
     * @return string
     */
    public static function get_money_value($value)
    {
        if (is_null($value)) {
            return Html::tag('span');
        }
        
        // init
        $sign = "";
        
        switch (true) {
            case $value > 0:
                $class = "positive_value";
                $sign = "+";
                break;
            case $value < 0:
                $class = "negative_value";
                break;
            case $value == null:
                return ConstantsGeneral::SIGN_NOT_AVAILABLE;
                break;
            case $value == 0:
            default:
                $class = "neutral_value";
                break;
        }
        
        return Html::beginTag('span', [
                'class' => $class
        ]) . $sign . number_format($value, 2) . " €" . Html::endTag('span');
    }

    /**
     * get representation of a value with 2 digits
     *
     * @param $value $id            
     * @return string
     */
    public static function get_quantity_value($value)
    {
        if (is_numeric($value)) {
            if ($value == (int) $value) {
                $value = number_format($value, 0);
            } else {
                $value = number_format($value, 2);
            }
        }
        
        return $value;
    }
}
?>