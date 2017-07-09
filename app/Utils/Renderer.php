<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/23/17
 * Time: 3:42 PM
 */

namespace App\Utils;

abstract class Renderer {




    /**
     * Render error as text.
     *
     * @param \Throwable $error
     *
     * @return string
     */
    public static function renderThrowableAsText($error) {
        $text = sprintf('Type: %s' . PHP_EOL, get_class($error));

        if($code = $error->getCode()) {
            $text .= sprintf('Code: %s' . PHP_EOL, $error->getCode());
        }

        if($message = $error->getMessage()) {
            $text .= sprintf('Message: %s' . PHP_EOL, htmlentities($message));
        }

        if($file = $error->getFile()) {
            $text .= sprintf('File: %s' . PHP_EOL, $file);
        }

        if($line = $error->getLine()) {
            $text .= sprintf('Line: %s' . PHP_EOL, $line);
        }

        if($trace = $error->getTraceAsString()) {
            $text .= sprintf('Trace: %s', $trace);
        }

        return $text;
    }




    /**
     * Render error as HTML.
     *
     * @param \Throwable $error
     * @return string
     */
    public static function renderThrowableAsHtml($error) {
        $html = sprintf('<div><strong>Type:</strong> %s</div>', get_class($error));

        if(($code = $error->getCode())) {
            $html .= sprintf('<div><strong>Code:</strong> %s</div>', $code);
        }

        if(($message = $error->getMessage())) {
            $html .= sprintf('<div><strong>Message:</strong> %s</div>', htmlentities($message));
        }

        if(($file = $error->getFile())) {
            $html .= sprintf('<div><strong>File:</strong> %s</div>', $file);
        }

        if(($line = $error->getLine())) {
            $html .= sprintf('<div><strong>Line:</strong> %s</div>', $line);
        }

        if(($trace = $error->getTraceAsString())) {
            $html .= '<h2>Trace</h2>';
            $html .= sprintf('<pre>%s</pre>', htmlentities($trace));
        }

        return $html;
    }




    /**
     * Render HTML error page.
     *
     * @param \Throwable $error
     * @param bool $displayErrorDetails
     *
     * @return string
     */
    public static function renderHtmlInternalErrorOutput($error, $displayErrorDetails) {
        $title = 'Server Error';

        if($displayErrorDetails) {
            $html = '<p>The application could not run because of the following error:</p>';
            $html .= '<h2>Details</h2>';
            $html .= Renderer::renderThrowableAsHtml($error);

            while ($error = $error->getPrevious()) {
                $html .= '<h2>Previous error</h2>';
                $html .= Renderer::renderThrowableAsHtml($error);
            }
        } else {
            $html = '<p>An error has occurred. Sorry for the temporary inconvenience.</p>';
        }

        $output = sprintf(
            "<html><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8'>" .
            "<title>%s</title><style>body{margin:0;padding:30px;font:12px/1.5 Helvetica,Arial,Verdana," .
            "sans-serif;}h1{margin:0;font-size:48px;font-weight:normal;line-height:48px;}strong{" .
            "display:inline-block;width:65px;}</style></head><body><h1>%s</h1>%s</body></html>",
            $title,
            $title,
            $html
        );

        return $output;
    }




}