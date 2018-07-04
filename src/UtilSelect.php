<?php
namespace rayn2k\rzhelper;
use Yii;

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
}

?>