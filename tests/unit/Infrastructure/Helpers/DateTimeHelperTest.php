<?php

namespace UnitTest\Infrastructure\Services;

use Codeception\Test\Unit;
use Infrastructure\Helpers\DateTimeHelper;
use DateTime;

/**
 * Class DateTimeHelperTest
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class DateTimeHelperTest extends Unit
{
    /**
     * Tests formatDate() method
     */
    public function testFormatDate()
    {
        $dateTime = new DateTime();

        $result = DateTimeHelper::formatDate($dateTime);
        $this->assertNotNull($result);

        $result = DateTimeHelper::formatDate(null);
        $this->assertNull($result);

        $format = 'Y-m-d';
        $result = DateTimeHelper::formatDate($dateTime, $format);
        $this->assertTrue((DateTime::createFromFormat($format, $result) !== false));
    }
}
