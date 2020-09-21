<?php

namespace Infrastructure\Services;

use InvalidArgumentException;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger as MonologLogger;
use Psr\Log\LoggerInterface;

/**
 * Class Logger
 *
 * @author Tihomir Minev <t.minev@net-surf.net>
 */
class Logger implements LoggerInterface
{
    private ?MonologLogger $monolog = null;

    private array $availableLogLevels = [
        'debug',
        'info',
        'notice',
        'warning',
        'error',
        'critical',
        'alert',
        'emergency'
    ];

    private string $channelName = "application";

    private string $logFormat = "[%datetime%] %channel%.%level_name%: %message% %context% %extra%";

    private bool $loggingEnabled = true;

    private int $logLevel = MonologLogger::ERROR;

    /**
     * Create a new Logger instance
     *
     * @param bool $loggingEnabled
     * @param string|null $logFormat
     * @param int|null $logLevel
     */
    public function __construct(
        bool $loggingEnabled,
        string $logFormat = null,
        int $logLevel = null
    ) {
        if ($logFormat !== null) {
            $this->logFormat = $logFormat;
        }

        if ($logLevel !== null) {
            $this->logLevel = $logLevel;
        }

        $this->loggingEnabled = $loggingEnabled;
    }

    /**
     * Logs an emergency message to the logs
     *
     * @param string|array $message
     * @param array $context
     */
    public function emergency($message, array $context = [])
    {
        $this->createLog('emergency', $message, $context);
    }

    /**
     * Logs an alert message to the logs
     *
     * @param string|array $message
     * @param array $context
     */
    public function alert($message, array $context = [])
    {
        $this->createLog('alert', $message, $context);
    }

    /**
     * Logs a critical message to the logs
     *
     * @param string|array $message
     * @param array $context
     */
    public function critical($message, array $context = [])
    {
        $this->createLog('critical', $message, $context);
    }

    /**
     * Logs an error message to the logs
     *
     * @param string|array $message
     * @param array $context
     */
    public function error($message, array $context = [])
    {
        $this->createLog('error', $message, $context);
    }

    /**
     * Logs a warning message to the logs
     *
     * @param string|array $message
     * @param array $context
     */
    public function warning($message, array $context = [])
    {
        $this->createLog('warning', $message, $context);
    }

    /**
     * Logs a notice to the logs
     *
     * @param string|array $message
     * @param array $context
     */
    public function notice($message, array $context = [])
    {
        $this->createLog('notice', $message, $context);
    }

    /**
     * Logs an informational message to the logs
     *
     * @param string|array $message
     * @param array $context
     */
    public function info($message, array $context = [])
    {
        $this->createLog('info', $message, $context);
    }

    /**
     * Logs a debug message to the logs
     *
     * @param string|array $message
     * @param array $context
     */
    public function debug($message, array $context = [])
    {
        $this->createLog('debug', $message, $context);
    }

    /**
     * Logs a message to the logs
     *
     * @param string $level
     * @param string|array $message
     * @param array $context
     */
    public function log($level, $message, array $context = [])
    {
        if (!in_array($level, $this->availableLogLevels)) {
            throw new InvalidArgumentException('Invalid log level: ' . $level);
        }

        $this->{$level}($message, $context);
    }

    /**
     * Sets the internal monolog object
     *
     * @param MonologLogger $monolog
     */
    public function setMonolog(MonologLogger $monolog)
    {
        $this->monolog = $monolog;
    }

    /**
     * Returns the internal monolog object
     *
     * @return MonologLogger
     */
    public function getMonolog(): MonologLogger
    {
        if ($this->monolog === null) {
            $this->monolog = $this->setupMonolog();
        }

        return $this->monolog;
    }

    /**
     * Returns whether the logging is enabled or not
     *
     * @return bool
     */
    public function isLoggingEnabled(): bool
    {
        return $this->loggingEnabled;
    }

    /**
     * Creates log item
     *
     * @param string $level
     * @param array|string $message
     * @param array $context
     */
    private function createLog(string $level, $message, array $context = [])
    {
        if ($this->loggingEnabled) {
            $monolog = $this->getMonolog();
            $formatedMassage = $this->formatMessage($message);
            $maxLogEntryLength = 1000;
            $logEntries = str_split($formatedMassage, $maxLogEntryLength);

            foreach ($logEntries as $logEntry) {
                $monolog->{$level}($logEntry, $context);
            }
        }
    }

    /**
     * Initialize all monolog related stuff
     *
     * @return MonologLogger
     */
    private function setupMonolog(): MonologLogger
    {
        $monolog = new MonologLogger($this->channelName);
        $handler = new ErrorLogHandler(
            ErrorLogHandler::OPERATING_SYSTEM,
            $this->logLevel,
            true
        );
        $formatter = new LineFormatter($this->logFormat, null);
        $formatter->includeStacktraces();
        $handler->setFormatter($formatter);
        $monolog->pushHandler($handler);

        return $monolog;
    }

    /**
     * Format the parameters for the logger
     *
     * @param array|string $message
     *
     * @return string
     */
    private function formatMessage($message)
    {
        return var_export($message, true);
    }
}
