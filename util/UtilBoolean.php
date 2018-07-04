<?php
namespace rayn2k\rzhelper;
use Yii;

/**
 * helper class for all boolean issues
 *
 * @author RZ
 */
class UtilBoolean
{

    /**
     * get localized representation of a boolean true or false value
     *
     * @param boolean|int $bool_value
     * @return string
     */
    public static function get_bool_localized_string($bool_value)
    {
        // in case the input value is 0 or 1, change it to bool value
        if (is_numeric($bool_value)) {
            $bool_value = $bool_value == 1 ? true : false;
        }
        
        if ($bool_value == true) {
            return Yii::t('app', 'true');
        } else {
            return Yii::t('app', 'false');
        }
    }

    /**
     * get glyphicon representation as checkmark or cross of a boolean true or false value
     *
     * @param boolean|int $bool_value
     * @return string
     */
    public static function get_bool_glyphicon($bool_value)
    {
        // in case the input value is 0 or 1, change it to bool value
        if (is_numeric($bool_value)) {
            $bool_value = $bool_value == 1 ? true : false;
        }
        
        if ($bool_value == true) {
            return "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>";
        } else {
            return "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>";
        }
    }
}
?>