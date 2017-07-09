<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/2/17
 * Time: 9:02 PM
 */

namespace App\Model;

use App\Utils\ArrayUtils;
use App\Utils\Utils;

class Cursor {


    const TYPE_NEXT = 'next';
    const TYPE_PREVIOUS = 'previous';

    const COLUMN_ID = 'id';
    const COLUMN_FOLLOWER_COUNT = 'follower_count';
    const COLUMN_CREATED_AT = 'created_at';

    const PATTERN_COLUMN_ID = '/^\d{1,10}$/';
    const PATTERN_COLUMN_FOLLOWER_COUNT = '/^\d{1,10}$/';
    const PATTERN_COLUMN_CREATED_AT = '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/';

    const PARAMETER_DELIMITER = '|';


    /**
     * @var string
     */
    protected $type;

    /**
     * @var Parameter[]
     */
    protected $parameters;




    public function __construct() {
        $this->type = '';
        $this->parameters = array();
    }




    /**
     * @param string $type
     * @return $this
     */
    public function setType($type) {
        $this->type = $type;
        return $this;
    }




    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }




    /**
     * @return bool
     */
    public function hasType() {
        return Utils::isNotEmpty($this->type);
    }




    /**
     * @param Parameter[] $parameters
     * @return $this
     */
    public function setParameters($parameters) {
        $this->parameters = $parameters;
        return $this;
    }




    /**
     * @param Parameter $parameter
     * @param string $key
     *
     * @return $this
     */
    public function addParameter($key, $parameter) {
        $this->parameters[$key] = $parameter;
        return $this;
    }




    /**
     * @param string $key
     *
     * @return Parameter
     */
    public function getParameter($key) {
        return $this->parameters[$key];
    }




    /**
     * @return Parameter[]
     */
    public function getParameters() {
        return $this->parameters;
    }




    /**
     * @return bool
     */
    public function hasParameters() {
        return Utils::isNotEmpty($this->parameters);
    }




    /**
     * @inheritdoc
     */
    public function __toString() {
        $result = '';
        $index = 0;
        $lastIndex = (ArrayUtils::getSize($this->parameters)- 1);

        foreach($this->parameters as $parameter) {
            $result .= ($parameter->__toString());

            if($index !== $lastIndex) {
                $result .= self::PARAMETER_DELIMITER;
            }

            $index++;
        }

        return $result;
    }




}