<?php

namespace Infrastructure\Helpers;

use DateTime;
use DateTimeZone;

/**
 * Class DateTimeHelper
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class DateTimeHelper
{
    /**
     * Returns the given date as string with the given format
     *
     * @param DateTime $dateTime
     * @param string $format
     *
     * @return string | null
     */
    public static function formatDate(
        DateTime $dateTime = null,
        string $format = 'Y-m-d H:i:s'
    ): ?string {
        $formattedDateTime = null;

        if ($dateTime !== null) {
            if (strpos($format, 'Z') !== false) {
                $dt = clone $dateTime;
                $dt->setTimezone(new DateTimeZone("UTC"));
                $formattedDateTime = $dt->format($format);
            } else {
                $formattedDateTime = $dateTime->format($format);
            }
        }

        return $formattedDateTime;
    }
}
