<?php
namespace rayn2k\rzhelper;
use Yii;

class UtilDate
{

    const TIMEZONE_UTC = "UTC";

    /**
     * get the utc time for default time zone for the actual time
     *
     * @return \DateTime
     */
    public static function get_actual_utc()
    {
        $datetime_local = new \DateTime(date("Y-m-d H:i:s", time()), new \DateTimeZone(date_default_timezone_get()));
        return static::set_to_timezone_utc($datetime_local);
    }

    /**
     * get the utc time for default time zone for the actual time
     *
     * @return string
     */
    public static function get_actual_utc_sql_string()
    {
        return static::datetime_to_sqlstring(static::get_actual_utc());
    }

    /**
     * get the utc time for default time zone for the actual time as LONG representation
     *
     * @return integer
     */
    public static function get_actual_utc_long()
    {
        return static::datetime_to_long(static::get_actual_utc());
    }

    /**
     * get the datetime representation of a given long timestamp
     *
     * @param integer $timestamp
     * @return \DateTime
     */
    public static function get_utc_datetime_from_long($timestamp)
    {
        return new \DateTime(gmdate("Y-m-d\TH:i:s\Z", $timestamp), new \DateTimeZone(static::TIMEZONE_UTC));
    }

    /**
     * Convert a german formatted date to a datetime object
     *
     * @param String $german_formatted_date
     *            e.g. 01.01.2000
     * @return \DateTime
     */
    public static function get_datetime_from_german_date($german_formatted_date)
    {
        return \DateTime::createFromFormat('d.m.Y', $german_formatted_date);
    }

    /**
     * set a given DateTime object to timezone UTC
     *
     * @param \DateTime $datetime_local
     * @return \DateTime
     */
    public static function set_to_timezone_utc(\DateTime $datetime_timezone)
    {
        return $datetime_timezone->setTimezone(new \DateTimeZone(static::TIMEZONE_UTC));
    }

    /**
     * set a given DateTime object to timezone from server default
     *
     * @param \DateTime $datetime_local
     * @return \DateTime
     */
    public static function set_to_timezone_server_default(\DateTime $datetime_timezone)
    {
        return $datetime_timezone->setTimezone(new \DateTimeZone(date_default_timezone_get()));
    }

    /**
     * set a given DateTime object to german timezone
     *
     * @param \DateTime $datetime_local
     * @return \DateTime
     */
    public static function set_to_timezone_germany(\DateTime $datetime_timezone)
    {
        return $datetime_timezone->setTimezone(new \DateTimeZone('Europe/Berlin'));
    }

    /**
     * get the date sql string representation of a given datetime object
     *
     * @param \DateTime $datetime
     * @return string|NULL
     */
    public static function date_to_sqlstring(\DateTime $datetime)
    {
        return $datetime->format('Y-m-d');
    }

    /**
     * get the sql string representation of a given datetime object
     *
     * @param \DateTime $datetime
     * @return string|NULL
     */
    public static function datetime_to_sqlstring(\DateTime $datetime)
    {
        return $datetime->format('Y-m-d H:i:s');
    }

    /**
     * set to utc timezone and get the sql string representation of a given datetime object
     *
     * @param \DateTime $datetime
     * @return string|NULL
     */
    public static function datetime_to_sqlstring_utc(\DateTime $datetime)
    {
        return static::set_to_timezone_utc($datetime)->format('Y-m-d H:i:s');
    }

    /**
     * get the LONG representation of a given datetime object
     *
     * @param \DateTime $datetime
     * @return integer
     */
    public static function datetime_to_long(\DateTime $datetime)
    {
        return $datetime->getTimestamp();
    }

    /**
     * get the datetime object in utc by a given sql string representation
     *
     * @param string $datetime
     * @return \DateTime
     */
    public static function sqlstring_to_datetime_utc($datetime_sql_string)
    {
        return new \DateTime($datetime_sql_string, new \DateTimeZone(static::TIMEZONE_UTC));
    }

    /**
     * get the datetime object in the server default timezone by a given sql string representation
     *
     * @param string $datetime
     * @return \DateTime
     */
    public static function sqlstring_to_datetime_serverdefault($datetime_sql_string)
    {
        return new \DateTime($datetime_sql_string, new \DateTimeZone(date_default_timezone_get()));
    }

    /**
     * get the name of the day
     *
     *
     * @param string $datetime
     * @return \DateTime
     */
    public static function get_day_name(\DateTime $dateTime)
    {
        // number for ISO-8601
        $dayNumber = $dateTime->format('N');

        $dayNames = [
                1 => Yii::t('app', 'Monday'),
                2 => Yii::t('app', 'Tuesday'),
                3 => Yii::t('app', 'Wednesday'),
                4 => Yii::t('app', 'Thursday'),
                5 => Yii::t('app', 'Friday'),
                6 => Yii::t('app', 'Saturday'),
                7 => Yii::t('app', 'Sunday')
        ];

        return $dayNames[$dayNumber];
    }

    /**
     * get the name of the day in only a few letters
     *
     *
     * @param string $datetime
     * @return \DateTime
     */
    public static function get_day_name_short(\DateTime $dateTime)
    {
        // number for ISO-8601
        $dayNumber = $dateTime->format('N');

        $dayNames = [
                1 => Yii::t('app', 'Mon'),
                2 => Yii::t('app', 'Tue'),
                3 => Yii::t('app', 'Wed'),
                4 => Yii::t('app', 'Thu'),
                5 => Yii::t('app', 'Fri'),
                6 => Yii::t('app', 'Sat'),
                7 => Yii::t('app', 'Sun')
        ];

        return $dayNames[$dayNumber];
    }

    /**
     * get the german representation of a date
     *
     * @param string $datetime
     * @return String
     */
    public static function get_formatted_date_german(\DateTime $dateTime)
    {
        return $dateTime->format('d.m.Y');
    }

    /**
     * get the german representation of a date with the year representation in 2 digits.
     *
     * @param string $datetime
     * @return String
     */
    public static function get_formatted_date_german_2_digit_year(\DateTime $dateTime)
    {
        return $dateTime->format('d.m.y');
    }

    /**
     * get the german representation of a date showing only day and month.
     *
     * @param string $datetime
     * @return String
     */
    public static function get_formatted_date_german_without_year(\DateTime $dateTime)
    {
        return $dateTime->format('d.m.');
    }

    /**
     * get the german representation of a time
     *
     * @param string $datetime
     * @return String
     */
    public static function get_formatted_time_german(\DateTime $dateTime)
    {
        return $dateTime->format('H:i');
    }
}