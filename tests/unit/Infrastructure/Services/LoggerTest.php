<?php

namespace UnitTest\Infrastructure\Services;

use Infrastructure\Services\Logger;
use Monolog\Logger as MonologLogger;
use Codeception\Test\Unit;

/**
 * Class LoggerTest
 *
 * @author Grigor Milchev <grigor@devision.bg>
 */
class LoggerTest extends Unit
{
    /**
     * Tests whether the monolog's debug method will be executed when the
     * logging is enabled
     */
    public function testLogWhenLoggingIsEnabled()
    {
        $loggingEnabled = true;
        $channelName = null;
        $logItem = 'test';

        $monologMock = $this->getMockBuilder(MonologLogger::class)
            ->setConstructorArgs(['channelName'])
            ->setMethods([
                'emergency',
                'alert',
                'debug',
                'warning',
                'notice',
                'error',
                'critical',
                'info'
            ])
            ->getMock();

        $monologMock->expects($this->once())
            ->method('emergency')
            ->with($this->equalTo("'$logItem'"));
        $monologMock->expects($this->once())
            ->method('alert')
            ->with($this->equalTo("'$logItem'"));
        $monologMock->expects($this->once())
            ->method('debug')
            ->with($this->equalTo("'$logItem'"));
        $monologMock->expects($this->once())
            ->method('warning')
            ->with($this->equalTo("'$logItem'"));
        $monologMock->expects($this->once())
            ->method('notice')
            ->with($this->equalTo("'$logItem'"));
        $monologMock->expects($this->once())
            ->method('error')
            ->with($this->equalTo("'$logItem'"));
        $monologMock->expects($this->once())
            ->method('critical')
            ->with($this->equalTo("'$logItem'"));
        $monologMock->expects($this->once())
            ->method('info')
            ->with($this->equalTo("'$logItem'"));

        $logger = new Logger($loggingEnabled, $channelName);
        $logger->setMonolog($monologMock);

        $logger->emergency($logItem);
        $logger->alert($logItem);
        $logger->debug($logItem);
        $logger->warning($logItem);
        $logger->notice($logItem);
        $logger->error($logItem);
        $logger->critical($logItem);
        $logger->info($logItem);
    }

    /**
     * Tests whether the monolog's debug method will be executed when the
     * logging is disabled
     */
    public function testLogWhenLoggingIsDisabled()
    {
        $loggingEnabled = false;
        $channelName = null;

        $monologMock = $this->getMockBuilder(MonologLogger::class)
            ->setConstructorArgs(['channelName'])
            ->setMethods(['debug'])
            ->getMock();
        $monologMock
            ->expects($this->exactly(0))
            ->method('debug');

        $logger = new Logger($loggingEnabled, $channelName);
        $logger->setMonolog($monologMock);

        $logger->debug('test');
    }
}