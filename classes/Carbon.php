<?php

/*
 * This file is part of the Carbon package. It has been modified by Steve Patterson to remove functionality that is not needed in OurTrack.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Carbon;

use Closure;
use DateTime;
use DateTimeZone;
use DateInterval;
use DatePeriod;
use InvalidArgumentException;


class Carbon extends DateTime
{
    /**
     * The day constants
     */
    const SUNDAY = 0;
    const MONDAY = 1;
    const TUESDAY = 2;
    const WEDNESDAY = 3;
    const THURSDAY = 4;
    const FRIDAY = 5;
    const SATURDAY = 6;

    /**
     * Names of days of the week.
     *
     * @var array
     */
    protected static $days = array(
        self::SUNDAY => 'Sunday',
        self::MONDAY => 'Monday',
        self::TUESDAY => 'Tuesday',
        self::WEDNESDAY => 'Wednesday',
        self::THURSDAY => 'Thursday',
        self::FRIDAY => 'Friday',
        self::SATURDAY => 'Saturday'
    );

    /**
     * Terms used to detect if a time passed is a relative date for testing purposes
     *
     * @var array
     */
    protected static $relativeKeywords = array(
        'this',
        'next',
        'last',
        'tomorrow',
        'yesterday',
        '+',
        '-',
        'first',
        'last',
        'ago'
    );

    /**
     * Number of X in Y
     */
    const YEARS_PER_CENTURY = 100;
    const YEARS_PER_DECADE = 10;
    const MONTHS_PER_YEAR = 12;
    const WEEKS_PER_YEAR = 52;
    const DAYS_PER_WEEK = 7;
    const HOURS_PER_DAY = 24;
    const MINUTES_PER_HOUR = 60;
    const SECONDS_PER_MINUTE = 60;

    /**
     * Default format to use for __toString method when type juggling occurs.
     *
     * @var string
     */
    const DEFAULT_TO_STRING_FORMAT = 'Y-m-d H:i:s';

    /**
     * Format to use for __toString method when type juggling occurs.
     *
     * @var string
     */
    protected static $toStringFormat = self::DEFAULT_TO_STRING_FORMAT;

    /**
     * A test Carbon instance to be returned when now instances are created
     *
     * @var Carbon
     */
    protected static $testNow;

    /**
     * Creates a DateTimeZone from a string or a DateTimeZone
     *
     * @param DateTimeZone|string $object
     *
     * @return DateTimeZone
     *
     * @throws InvalidArgumentException
     */
    protected static function safeCreateDateTimeZone($object)
    {
        if ($object instanceof DateTimeZone) {
            return $object;
        }

        $tz = @timezone_open((string) $object);

        if ($tz === false) {
            throw new InvalidArgumentException('Unknown or bad timezone ('.$object.')');
        }

        return $tz;
    }

    ///////////////////////////////////////////////////////////////////
    //////////////////////////// CONSTRUCTORS /////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Create a new Carbon instance.
     *
     * Please see the testing aids section (specifically static::setTestNow())
     * for more on the possibility of this constructor returning a test instance.
     *
     * @param string              $time
     * @param DateTimeZone|string $tz
     */
    public function __construct($time = null, $tz = null)
    {
        // If the class has a test now set and we are trying to create a now()
        // instance then override as required
        if (static::hasTestNow() && (empty($time) || $time === 'now' || static::hasRelativeKeywords($time))) {
            $testInstance = clone static::getTestNow();
            if (static::hasRelativeKeywords($time)) {
                $testInstance->modify($time);
            }

            //shift the time according to the given time zone
            if ($tz !== NULL && $tz != static::getTestNow()->tz) {
                $testInstance->setTimezone($tz);
            } else {
                $tz = $testInstance->tz;
            }

            $time = $testInstance->toDateTimeString();
        }

        if ($tz !== null) {
            parent::__construct($time, static::safeCreateDateTimeZone($tz));
        } else {
            parent::__construct($time);
        }
    }

    /**
     * Create a Carbon instance from a DateTime one
     *
     * @param DateTime $dt
     *
     * @return static
     */
    public static function instance(DateTime $dt)
    {
        return new static($dt->format('Y-m-d H:i:s.u'), $dt->getTimeZone());
    }

    /**
     * Create a carbon instance from a string.  This is an alias for the
     * constructor that allows better fluent syntax as it allows you to do
     * Carbon::parse('Monday next week')->fn() rather than
     * (new Carbon('Monday next week'))->fn()
     *
     * @param string              $time
     * @param DateTimeZone|string $tz
     *
     * @return static
     */
    public static function parse($time = null, $tz = null)
    {
        return new static($time, $tz);
    }

    /**
     * Get a Carbon instance for the current date and time
     *
     * @param DateTimeZone|string $tz
     *
     * @return static
     */
    public static function now($tz = null)
    {
        return new static(null, $tz);
    }

    
    /**
     * Create a Carbon instance from a timestamp
     *
     * @param integer             $timestamp
     * @param DateTimeZone|string $tz
     *
     * @return static
     */
    public static function createFromTimestamp($timestamp, $tz = null)
    {
        return static::now($tz)->setTimestamp($timestamp);
    }


    /**
     * Get a copy of the instance
     *
     * @return static
     */
    public function copy()
    {
        return static::instance($this);
    }

    ///////////////////////////////////////////////////////////////////
    ///////////////////////// GETTERS AND SETTERS /////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Get a part of the Carbon object
     *
     * @param string $name
     *
     * @throws InvalidArgumentException
     *
     * @return string|integer|DateTimeZone
     */
    public function __get($name)
    {
        switch ($name) {
            case 'year':
            case 'month':
            case 'day':
            case 'hour':
            case 'minute':
            case 'second':
            case 'micro':
            case 'dayOfWeek':
            case 'dayOfYear':
            case 'weekOfYear':
            case 'daysInMonth':
            case 'timestamp':
                $formats = array(
                    'year' => 'Y',
                    'month' => 'n',
                    'day' => 'j',
                    'hour' => 'G',
                    'minute' => 'i',
                    'second' => 's',
                    'micro' => 'u',
                    'dayOfWeek' => 'w',
                    'dayOfYear' => 'z',
                    'weekOfYear' => 'W',
                    'daysInMonth' => 't',
                    'timestamp' => 'U',
                );

                return (int) $this->format($formats[$name]);

            case 'weekOfMonth':
                return (int) ceil($this->day / self::DAYS_PER_WEEK);

            case 'age':
                return (int) $this->diffInYears();

            case 'quarter':
                return (int) ceil($this->month / 3);

            case 'offset':
                return $this->getOffset();

            case 'offsetHours':
                return $this->getOffset() / self::SECONDS_PER_MINUTE / self::MINUTES_PER_HOUR;

            case 'dst':
                return $this->format('I') == '1';

            case 'local':
                return $this->offset == $this->copy()->setTimezone(date_default_timezone_get())->offset;

            case 'utc':
                return $this->offset == 0;

            case 'timezone':
            case 'tz':
                return $this->getTimezone();

            case 'timezoneName':
            case 'tzName':
                return $this->getTimezone()->getName();

            default:
                throw new InvalidArgumentException(sprintf("Unknown getter '%s'", $name));
        }
    }

    /**
     * Check if an attribute exists on the object
     *
     * @param string $name
     *
     * @return boolean
     */
    public function __isset($name)
    {
        try {
            $this->__get($name);
        } catch (InvalidArgumentException $e) {
            return false;
        }

        return true;
    }

    /**
     * Set a part of the Carbon object
     *
     * @param string                      $name
     * @param string|integer|DateTimeZone $value
     *
     * @throws InvalidArgumentException
     */
    public function __set($name, $value)
    {
        switch ($name) {
            case 'year':
                parent::setDate($value, $this->month, $this->day);
                break;

            case 'month':
                parent::setDate($this->year, $value, $this->day);
                break;

            case 'day':
                parent::setDate($this->year, $this->month, $value);
                break;

            case 'hour':
                parent::setTime($value, $this->minute, $this->second);
                break;

            case 'minute':
                parent::setTime($this->hour, $value, $this->second);
                break;

            case 'second':
                parent::setTime($this->hour, $this->minute, $value);
                break;

            case 'timestamp':
                parent::setTimestamp($value);
                break;

            case 'timezone':
            case 'tz':
                $this->setTimezone($value);
                break;

            default:
                throw new InvalidArgumentException(sprintf("Unknown setter '%s'", $name));
        }
    }

    

    ///////////////////////////////////////////////////////////////////
    ///////////////////////// TESTING AIDS ////////////////////////////
    ///////////////////////////////////////////////////////////////////

    /**
     * Set a Carbon instance (real or mock) to be returned when a "now"
     * instance is created.  The provided instance will be returned
     * specifically under the following conditions:
     *   - A call to the static now() method, ex. Carbon::now()
     *   - When a null (or blank string) is passed to the constructor or parse(), ex. new Carbon(null)
     *   - When the string "now" is passed to the constructor or parse(), ex. new Carbon('now')
     *
     * Note the timezone parameter was left out of the examples above and
     * has no affect as the mock value will be returned regardless of its value.
     *
     * To clear the test instance call this method using the default
     * parameter of null.
     *
     * @param Carbon $testNow
     */
    public static function setTestNow(Carbon $testNow = null)
    {
        static::$testNow = $testNow;
    }

    /**
     * Get the Carbon instance (real or mock) to be returned when a "now"
     * instance is created.
     *
     * @return static the current instance used for testing
     */
    public static function getTestNow()
    {
        return static::$testNow;
    }

    /**
     * Determine if there is a valid test instance set. A valid test instance
     * is anything that is not null.
     *
     * @return boolean true if there is a test instance, otherwise false
     */
    public static function hasTestNow()
    {
        return static::getTestNow() !== null;
    }

    /**
     * Determine if there is a relative keyword in the time string, this is to
     * create dates relative to now for test instances. e.g.: next tuesday
     *
     * @param string $time
     *
     * @return boolean true if there is a keyword, otherwise false
     */
    public static function hasRelativeKeywords($time)
    {
        // skip common format with a '-' in it
        if (preg_match('/[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}/', $time) !== 1) {
            foreach (static::$relativeKeywords as $keyword) {
                if (stripos($time, $keyword) !== false) {
                    return true;
                }
            }
        }

        return false;
    }


    /**
     * Determines if the instance is greater (after) than another
     *
     * @param Carbon $dt
     *
     * @return boolean
     */
    public function gt(Carbon $dt)
    {
        return $this > $dt;
    }

   

    
    

    /**
     * Get the difference in seconds
     *
     * @param Carbon  $dt
     * @param boolean $abs Get the absolute of the difference
     *
     * @return integer
     */
    public function diffInSeconds(Carbon $dt = null, $abs = true)
    {
        $value = (($dt === null) ? time() : $dt->getTimestamp()) - $this->getTimestamp();

        return $abs ? abs($value) : $value;
    }

    /**
     * Get the difference in a human readable format.
     *
     * When comparing a value in the past to default now:
     * 1 hour ago
     * 5 months ago
     *
     * When comparing a value in the future to default now:
     * 1 hour from now
     * 5 months from now
     *
     * When comparing a value in the past to another value:
     * 1 hour before
     * 5 months before
     *
     * When comparing a value in the future to another value:
     * 1 hour after
     * 5 months after
     *
     * @param Carbon $other
     *
     * @return string
     */
    public function diffForHumans(Carbon $other = null)
    {
        $isNow = $other === null;

        if ($isNow) {
            $other = static::now($this->tz);
        }

        $isFuture = $this->gt($other);

        $delta = $other->diffInSeconds($this);

        // a little weeks per month, 365 days per year... good enough!!
        $divs = array(
            'second' => self::SECONDS_PER_MINUTE,
            'minute' => self::MINUTES_PER_HOUR,
            'hour' => self::HOURS_PER_DAY,
            'day' => self::DAYS_PER_WEEK,
            'week' => 30 / self::DAYS_PER_WEEK,
            'month' => self::MONTHS_PER_YEAR
        );

        $unit = 'year';

        foreach ($divs as $divUnit => $divValue) {
            if ($delta < $divValue) {
                $unit = $divUnit;
                break;
            }

            $delta = $delta / $divValue;
        }

        $delta = (int) $delta;

        if ($delta == 0) {
            $delta = 1;
        }

        $txt = $delta . ' ' . $unit;
        $txt .= $delta == 1 ? '' : 's';

        if ($isNow) {
            if ($isFuture) {
                return $txt . ' from now';
            }

            return $txt . ' ago';
        }

        if ($isFuture) {
            return $txt . ' after';
        }

        return $txt . ' before';
    }

   
}