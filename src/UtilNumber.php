<?php
namespace rayn2k\rzhelper;
use yii\base\InvalidArgumentException;
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
    public static function get_money_value($value, $show_positive_sign = true)
    {
        if (is_null($value)) {
            return Html::tag('span');
        }

        // init
        $sign = "";

        switch (true) {
            case $value > 0:
                $class = "positive_value";
                $sign = $show_positive_sign ? "+" : "";
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
     * get representation of a value
     *
     * @param $value $id
     * @return string
     */
    public static function get_points_value($value, $show_positive_sign = true)
    {
        if (is_null($value)) {
            return Html::tag('span');
        }

        // init
        $sign = "";

        switch (true) {
            case $value > 0:
                $class = "positive_value";
                $sign = $show_positive_sign ? "+" : "";
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
        ]) . $sign . $value . Html::endTag('span');
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

    /**
     * get representation of a value a given number of digits containing leading zeros
     */
    public static function get_fix_digit_value_with_leading_zeros($value, $number_of_digits)
    {
        if (! is_numeric($value)) {
            throw new InvalidArgumentException("The input value is not a valid number.");
        }

        if (! is_numeric($number_of_digits)) {
            throw new InvalidArgumentException("The input number of digits is not a valid number.");
        }

        return sprintf('%0' . $number_of_digits . 'd', $value);
    }

    /**
     * Get a string representation for a given number like 1 => 1st or 5 => 5th
     */
    public static function get_number_string($number)
    {
        if (! is_numeric($number)) {
            throw new InvalidArgumentException("The input number is not a valid numeric value.");
        }

        $last_digit = substr($number, - 1);

        if ($number == 11 || $number == 12 || $number == 13) {
            $number_string = $number . "th";
        } else {
            switch ($last_digit) {
                case 1:
                    $number_string = $number . "st";
                    break;
                case 2:
                    $number_string = $number . "nd";
                    break;
                case 3:
                    $number_string = $number . "rd";
                    break;
                default:
                    $number_string = $number . "th";
                    break;
            }
        }

        return $number_string;
    }

    /**
     * Returns true, when both given numbers has the same sign sign and false, if not.
     *
     * @param number $number1
     * @param number $number2
     * @return boolean
     */
    public static function has_same_sign($number1, $number2)
    {
        if (! is_numeric($number1)) {
            throw new InvalidArgumentException("The input number is not a valid numeric value: " . $number1);
        }

        if (! is_numeric($number2)) {
            throw new InvalidArgumentException("The input number is not a valid numeric value: " . $number2);
        }

        if ($number1 > 0 && $number2 > 0) {
            return true;
        }

        if ($number1 < 0 && $number2 < 0) {
            return true;
        }

        if ($number1 == 0 && $number2 == 0) {
            return true;
        }

        return false;
    }

    /**
     * Return the round number with given precision.
     *
     * @param number $number
     * @param integer $precision
     * @return number
     */
    public static function round($number, $precision)
    {
        return round($number, 2);
    }
}
?>