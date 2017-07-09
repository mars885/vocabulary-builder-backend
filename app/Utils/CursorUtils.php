<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/31/17
 * Time: 9:49 AM
 */

namespace App\Utils;

use App\Model\Cursor;
use App\Model\Parameter;

abstract class CursorUtils {




    /**
     * @param string $cursorStr
     *
     * @return Cursor|null
     */
    public static function parseCursor($cursorStr) {
        $parametersStr = ArrayUtils::explode(Cursor::PARAMETER_DELIMITER, Utils::base64Decode($cursorStr));
        $parameters = array();

        foreach($parametersStr as $parameterStr) {
            $parts = ArrayUtils::explode(Parameter::DELIMITER, $parameterStr);

            if(ArrayUtils::getSize($parts) < 2) {
                return null;
            }

            if(!self::isColumnAcceptable($parts[0])) {
                return null;
            }

            if(!preg_match(self::getPatternForColumn($parts[0]), $parts[1])) {
                return null;
            }

            $parameters[$parts[0]] = (new Parameter())->setKey($parts[0])->setValue($parts[1]);
        }

        return (new Cursor())->setParameters($parameters);
    }




    /**
     * @param string $column
     *
     * @return bool
     */
    public static function isColumnAcceptable($column) {
        switch($column) {

        case Cursor::COLUMN_ID:
        case Cursor::COLUMN_FOLLOWER_COUNT:
        case Cursor::COLUMN_CREATED_AT:
            return true;

        default:
            return false;

        }
    }




    /**
     * @param string $column
     *
     * @return string
     */
    public static function getPatternForColumn($column) {
        switch($column) {

        case Cursor::COLUMN_ID:
            return Cursor::PATTERN_COLUMN_ID;

        case Cursor::COLUMN_FOLLOWER_COUNT:
            return Cursor::PATTERN_COLUMN_FOLLOWER_COUNT;

        case Cursor::COLUMN_CREATED_AT:
            return Cursor::PATTERN_COLUMN_CREATED_AT;

        default:
            return '';

        }
    }




    /**
     * @param Cursor $cursor
     *
     * @return bool
     */
    public static function isNextType($cursor) {
        return (Utils::isNotNull($cursor) && ($cursor->getType() === Cursor::TYPE_NEXT));
    }




    /**
     * @param Cursor $cursor
     *
     * @return bool
     */
    public static function isPreviousType($cursor) {
        return (Utils::isNotNull($cursor) && ($cursor->getType() === Cursor::TYPE_PREVIOUS));
    }




}