<?php
namespace Atto;

use Atto\Config;

/**
 * Simple logger class
 *
 * Usage
 *  $log = new Logger('../logs');
 *  $log->debug("Some debug log", 1003);
 *
 * @package   Atto
 *
 * @author    Andrei Alexandru Romila
 * @version   v1.0
 */
class Logger
{
    /**
     * All logging level
     */
    const ALL = 15;

    /**
     * Debug logging level
     */
    const DEBUG = 8;

    /**
     * Information logging level
     */
    const INFO = 4;

    /**
     * Warning logging level
     */
    const WARN = 2;

    /**
     * Error logging level
     */
    const ERROR = 1;

    /**
     * Configured log level
     *
     * @var int
     */
    protected $logLevel;

    /**
     * Log directory
     *
     * @var string
     */
    protected $directory;

    /**
     * Maximum file size before rotation
     *
     * @var integer
     */
    protected $filesize;

    /**
     * Logger private constructor
     *
     * @param $level
     * @param $directory
     */
    public function __construct($directory = null, $filesize = null, $level = null)
    {
        $this->directory = $directory === null ? Config::getProperty('logs.directory') : $directory;
        $this->filesize  = $filesize  === null ? Config::getProperty('logs.filesize')  : $filesize;
        $this->logLevel  = $level     === null ? Config::getProperty('logs.level')     : $level;
    }

    /**
     * Stores a new debug message.
     *
     * @param      $message string The message to store
     * @param null $code    int The code
     */
    public function debug($message, $code = null)
    {
        return $this->log($message, $code, self::DEBUG);
    }

    /**
     * Creates a new info message
     *
     * @param      $message
     * @param null $code
     */
    public function info($message, $code = null)
    {
        return $this->log($message, $code, self::INFO);
    }

    /**
     * Creates a new warning message
     *
     * @param      $message
     * @param null $code
     */
    public function warn($message, $code = null)
    {
        return $this->log($message, $code, self::WARN);
    }

    /**
     * Creates a new error message
     *
     * @param      $message
     * @param null $code
     */
    public function error($message, $code = null)
    {
        return $this->log($message, $code, self::ERROR);
    }

    /**
     * Stores a new log message in the buffer
     *
     * @param $message string The message to store
     * @param $code    int The code
     * @param $level   int Log message type (ERROR, WARN, INFO, DEBUG)
     */
    public function log($message, $code, $level)
    {
        $level = (int) $level;

        if (($level & $this->logLevel) === 0) {
            return;
        }

        $line  = $this->formatTime(microtime());
        $line .= sprintf(" [%s] ", $this->getDescription($level));
        $line .= $this->formatCode($code);
        $line .= ' ';
        $line .= $this->formatMessage($message);
        $line .= PHP_EOL;

        $filename = $this->getFilename($this->directory, $this->filesize);

        return file_put_contents($filename, $line, LOCK_EX | FILE_APPEND);
    }

    /**
     * Returns the filename
     *
     * @param string $directory Path to the log files
     * @param int $filesize Maximum file size before rotation
     *
     * @return string The log filename
     */
    protected function getFilename($directory, $filesize)
    {
        // Get all files from directory
        $files = scandir($directory, SCANDIR_SORT_NONE);
        $filename = $directory . '/atto-' . date('Y.m.d') . '-0.log';
        $rotation = 0;

        foreach ($files as $file) {
            if (preg_match('/atto-' . date('Y.m.d') . '-([0-9]+)\.log/', $file, $matches)) {

                if ($rotation < $matches[1]) {
                    $rotation = $matches[1];
                    $filename = $directory . '/' . $file;
                }
            }
        }

        if (!file_exists($filename) || filesize($filename) < $filesize || $filesize < 1) {
            return $filename;
        }

        // Get a new filename
        return $directory . '/' . 'atto-' . date('Y.m.d') . '-' . ++$rotation . '.log';
    }

    /**
     * Returns the description for the given log level
     *
     * @param $level
     *
     * @return string
     */
    protected function getDescription($level)
    {

        if ($level === self::ERROR) {
            return 'ERROR';
        } else if ($level === self::WARN) {
            return 'WARN ';
        } else if ($level === self::INFO) {
            return 'INFO ';
        } else if ($level === self::DEBUG) {
            return 'DEBUG';
        }

        return 'UNKNOWN';
    }

    /**
     * If there are new lines in the message we will put a tab after each one
     *
     * @param $message
     *
     * @return mixed
     */
    protected function formatMessage($message)
    {
        return str_replace("\n", "\n\t", $message);
    }

    /**
     * Formats the code using 5 numbers.
     *  If null is passed to the function '00000' is returned
     *  If 404 is passed '00404' is returned
     *  If 10022 is passed '10022' is returned.
     *
     * @param null $code
     *
     * @return int|null|string
     */
    protected function formatCode($code = null)
    {
        if ($code === null) {
            $code = 0;
        }

        if (($length = strlen($code)) < 5) {
            $code = str_repeat('0', 5 - $length) . $code;
        }

        return $code;
    }

    /**
     * Formats the time: 16:32:02.3380
     *
     * @param $timestamp
     *
     * @return string
     */
    protected function formatTime($timestamp = null)
    {
        if ($timestamp === null) {
            $timestamp = microtime();
        }

        list($micro, $sec) = explode(' ', $timestamp);

        return date('H:i:s', $sec) . '.' . substr($micro, 2, 4);
    }

}
