<?php
namespace rayn2k\rzhelper;

/**
 * helper class for file related issues
 *
 * @author RZ
 */
class UtilFile
{

    public static function get_file_names_from_directory($path_to_directory)
    {
        $entries = array();
        
        if ($handle = opendir($path_to_directory)) {
            
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $entries[] = $entry;
                }
            }
            closedir($handle);
        }
        
        asort($entries);
        
        return $entries;
    }

    public static function get_file_name_without_type($full_entry)
    {
        return UtilString::get_string_until_last_position_of_needle($full_entry, ".");
    }

    public static function get_file_type_from_name($full_entry)
    {
        return UtilString::get_string_without_prefix(UtilString::get_string_from_last_position_of_needle($full_entry, "."), ".");
    }

    /**
     *
     * @param String $filepath
     * @param String $period
     *            e.g. 'P820DT11H24M'
     * @return boolean
     */
    public static function add_period_to_last_modified_timestamp($filepath, $period)
    {
        if (file_exists($filepath)) {
            $touch_time = filemtime($filepath);
            
            $dateTime = new \DateTime();
            $dateTime->setTimestamp($touch_time);
            $dateTime->add(new \DateInterval($period));
            
            return static::set_last_modified_timestamp($filepath, $dateTime->getTimestamp());
        }
        return false;
    }

    /**
     *
     * @param String $filepath
     * @param String $timestamp
     *            long UNIX timestamp
     * @return boolean
     */
    public static function set_last_modified_timestamp($filepath, $timestamp)
    {
        if (file_exists($filepath)) {
            touch($filepath, $timestamp);
            return true;
        }
        return false;
    }
}
?>