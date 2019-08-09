<?php
namespace rayn2k\rzhelper;
use yii\helpers\StringHelper;

/**
 * utility class to handle several string operations
 *
 * @author RZ
 */
class UtilString extends StringHelper
{

    /**
     * remove the given prefix from the string
     *
     * @param string $string
     * @param string $prefix
     * @return string
     */
    public static function get_string_without_prefix($string, $prefix)
    {

        // TODO: distinguish between prefix at the beginning and in between

        // case prefix is not included
        if (strpos($string, $prefix) === false) {
            return $string;
        }

        return mb_substr($string, strlen($prefix), strlen($string), 'UTF-8');
    }

    /**
     * remove the given suffix from the string
     *
     * @param string $string
     * @param string $prefix
     * @return string
     */
    public static function get_string_without_suffix($string, $suffix)
    {

        // TODO: distinguish between prefix at the beginning and in between

        // case prefix is not included
        if (strpos($string, $suffix) === false) {
            return $string;
        }

        return mb_substr($string, 0, strlen($string) - strlen($suffix), 'UTF-8');
    }

    /**
     * Return the substring until the last position of a needle.
     *
     * @param string $string
     * @param string $needle
     * @return string
     */
    public static function get_string_until_last_position_of_needle($string, $needle)
    {
        if (strrpos($string, $needle) === false) {
            return $string;
        }

        $pos = strrpos($string, $needle);

        return mb_substr($string, 0, $pos, 'UTF-8');
    }

    /**
     * Return the substring from the last position of a needle.
     *
     * @param string $string
     * @param string $needle
     * @return string
     */
    public static function get_string_from_last_position_of_needle($string, $needle)
    {
        if (strrpos($string, $needle) === false) {
            return $string;
        }

        $pos = strrpos($string, $needle);

        return mb_substr($string, $pos, strlen($string), 'UTF-8');
    }

    /**
     * get the string, which is bordered between 2 delimiters
     *
     * @param string $delimiter1
     * @param string $delimiter2
     * @return string
     */
    public static function get_string_between_delimiters($text, $delimiter1, $delimiter2, $show = false)
    {
        $parts = explode($delimiter1, $text);
        $text_after_delimiter1 = $parts[1];
        $parts = explode($delimiter2, $text_after_delimiter1);
        $text_before_delimiter2 = $parts[0];

        return $text_before_delimiter2;
    }

    /**
     * search backwards starting from haystack length characters from the end
     *
     * @param string $haystack
     * @param string $needle
     * @return boolean
     */
    public static function starts_with($haystack, $needle)
    {
        return $needle === "" || strrpos($haystack, $needle, - strlen($haystack)) !== false;
    }

    /**
     * search forward starting from end minus needle length characters
     *
     * @param string $haystack
     * @param string $needle
     * @return boolean
     */
    public static function ends_with($haystack, $needle)
    {
        return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
    }

    /**
     * Please use the underlying UtilString::explode function instead of split()!
     *
     * split text and remove whitespaces
     *
     * @param string $text
     * @param string $delimiter
     */
    public static function split($text, $delimiter)
    {
        // if $text is not containing the $delimiter, return null
        if (strrpos($text, $delimiter) === false) {
            return null;
        }

        // init
        $return_parts = array();

        // split into parts
        $text_parts = explode($delimiter, $text);

        // remove whitespaces
        foreach ($text_parts as $part) {
            $return_parts[] = trim($part);
        }

        return $return_parts;
    }

    /**
     * wrapper for string replace
     */
    public static function replace($text, $search, $replace)
    {
        return str_replace($search, $replace, $text);
    }

    /**
     * wrapper for uc words
     *
     * @param string $text
     */
    public static function uppercase_all_words($text)
    {
        return ucwords($text);
    }

    /**
     * wrapper for strtolower
     *
     * @param string $text
     */
    public static function lowercase_all($text)
    {
        return strtolower($text);
    }

    /**
     * remove all special chars and whitespaces from a string
     *
     * @param string $string
     * @return string
     */
    public static function get_string_without_special_chars($string)
    {
        // Replaces all spaces with underscores.
        $string = str_replace(' ', '_', $string);

        // Removes special chars.
        return preg_replace('/[^A-Za-z0-9\-_]/', '', $string);
    }

    /**
     * replace all whitespaces from a string with underscores
     *
     * @param string $string
     * @return string
     */
    public static function get_string_without_white_spaces($string)
    {
        return str_replace(' ', '_', $string);
    }

    /**
     * insert a string A ($needle) into a another string ($haystack) at a
     * respective position.
     * E.g. haystack AAA, needle B, position 2 will return AABA.
     *
     * @param string $haystack
     * @param string $needle
     * @param int $position
     * @return string
     */
    public static function insert_string_at_position($haystack, $needle, $position)
    {
        return substr($haystack, 0, $position) . $needle . substr($haystack, $position);
    }

    /**
     * checks, whether both given strings are the same without distinction of
     * case sensitive letters
     *
     * @param string $text1
     * @param string $text2
     * @return boolean
     */
    public static function equals_ignore_case($text1, $text2)
    {
        return strcasecmp($text1, $text2) == 0;
    }

    /**
     * checks, whether a given string is empty
     *
     * @param string $text
     * @return boolean
     */
    public static function is_empty($text)
    {
        return static::equals_ignore_case(trim($text), '');
    }

    /**
     * Set a highlighted format for the text.
     *
     * @param string $text
     */
    public static function highlight($text)
    {
        $response = "<span style='font-weight: bold;'>" . $text . "</span>";

        return $response;
    }
}

?>