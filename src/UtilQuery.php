<?php
namespace rayn2k\rzhelper;
use Yii;
use dosamigos\datepicker\DateRangePicker;
use trntv\yii\datetime\DateTimeWidget;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * utility class for Yii2 Queries
 *
 * @author RZ
 */
class UtilQuery
{

    /**
     * The ids, which are available as result in all incoming queries, are included in the response array.
     * This function accepts 1-n queries as arguments.
     *
     * @param string $parameter_name
     *            * @param array $queries
     * @return integer[]
     *
     * @formatter:off
     * [
     *   3
     *   5
     *   12
     * ]
     * @formatter:on
     */
    public static function get_list_of_ids_from_queries($parameter_name, $queries = [])
    {
        $result = [];
        $temp_arrays = [];
        $number_of_queries = sizeof($queries);

        for ($i = 0; $i < $number_of_queries; $i ++) {
            $query = $queries[$i];
            foreach ($query->all() as $query_object) {
                $temp_arrays[$i][] = $query_object->$parameter_name;
            }
        }

        // return only parameters, which are in all arrays using array_intersect (=Schnittmenge)
        if ($number_of_queries == 0) {
            $result = $temp_arrays;
        } elseif ($number_of_queries == 1) {
            $result = $temp_arrays[0];
        } elseif ($number_of_queries == 2) {
            $result = array_intersect($temp_arrays[0], $temp_arrays[1]);
        } else {
            $result = array_intersect($temp_arrays[0], $temp_arrays[1], $temp_arrays);
        }

        return $result;
    }
}

?>