<?php

namespace Core;

class Error
{

    /**
     * Error handler. Convert all errors to Exceptions by throwing an ErrorException.
     *
     * @param int $level  Error level
     * @param string $message  Error message
     * @param string $file  Filename the error was raised in
     * @param int $line  Line number in the file
     *
     * @return void
     */
    public static function errorHandler($level, $message, $file, $line)
    {
        if (error_reporting() !== 0) {  // to keep the @ operator working
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }

    /**
     * Exception handler.
     *
     * @param Exception $exception  The exception
     *
     * @return void
     */
    public static function exceptionHandler($exception)
    {
        // Code is 404 (not found) or 500 (general error)
        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }
        http_response_code($code);

        if (\App\Config::SHOW_ERRORS) {
            echo "<h1>Fatal error</h1>";
            echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
            echo "<p>Message: '" . $exception->getMessage() . "'</p>";
            echo "<p>Stack trace:<pre>" . $exception->getTraceAsString() . "</pre></p>";
            echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
        } else {
            $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.txt';
            ini_set('error_log', $log);

            $message = "Uncaught exception: '" . get_class($exception) . "'";
            $message .= " with message '" . $exception->getMessage() . "'";
            $message .= "\nStack trace: " . $exception->getTraceAsString();
            $message .= "\nThrown in '" . $exception->getFile() . "' on line " . $exception->getLine();

			self::SystemFailure($message,true,\App\Config::MAIL_ERRORS);
        }
    }

    // User error
    static $strError;

    /**
     * Write line to log file
     * @param string The line to write
     * @param string The file to write to
     * @returns boolean
     */
    static function WriteLogLine($strLogLine, $strLogFileName)
    {
        $resLogFile = fopen($strLogFileName, 'a');
        fwrite($resLogFile, $strLogLine . "\r\n");
        fclose($resLogFile);
    }

    /**
     * Show a nice error to user
     * @param string
     * @return void
     */
    static function UserException ()
    {
        die('Er is een interne fout opgetreden. Een ogenblik geduld a.u.b.');
    }

    /**
     * Report system failures to administrator(s)
     * @param string Error message
     * @param boolean Should it be logged, or just mailed? (optional)
     * @return boolean
     */
    static function SystemFailure ($strErrorMessage, $boolLogged = true, $boolMail = false)
    {
        $strLogLine = '[' . date('d-m-Y @ H:i') . ' on ' . $_SERVER["REQUEST_URI"] . '] ' . $strErrorMessage;

        if ($boolLogged)
            self::WriteLogLine($strLogLine, '../Logs/failure.log');

        if ($boolMail)
            mail(SYS_ADMIN, 'SYSTEM FAILURE ON ' . SYS_SITE_NAME . ' (' . SYS_SITE_URI . ')', $strLogLine, 'From:'. SYS_ADMIN);

        self::UserException();
    }

}
