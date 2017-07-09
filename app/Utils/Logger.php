<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/23/17
 * Time: 4:10 PM
 */

namespace App\Utils;

abstract class Logger {




    /**
     * @param \Throwable $error
     */
    public static function logError($error) {
        // Fetching info about the error
        $message = 'Server Error' . PHP_EOL;
        $message .= Renderer::renderThrowableAsText($error);

        // Fetching info about the previous errors (if any)
        while($error = $error->getPrevious()) {
            $message .= PHP_EOL . 'Previous error:' . PHP_EOL;
            $message .= Renderer::renderThrowableAsText($error);
        }

        // Logging the error
        error_log($message);
    }




}