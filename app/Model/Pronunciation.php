<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/5/17
 * Time: 9:08 PM
 */

namespace App\Model;

use App\Utils\Utils;
use JsonSerializable;

class Pronunciation implements JsonSerializable {


    const JSON_PROPERTY_ACCENT = 'accent';
    const JSON_PROPERTY_URL = 'url';


    /**
     * @var string
     */
    protected $accent;

    /**
     * @var string
     */
    protected $url;




    public function __construct() {
        $this->accent = '';
        $this->url = '';
    }




    /**
     * @param string $accent
     * @return $this
     */
    public function setAccent($accent) {
        $this->accent = $accent;
        return $this;
    }




    /**
     * @return string
     */
    public function getAccent() {
        return $this->accent;
    }




    /**
     * @return bool
     */
    public function hasAccent() {
        return Utils::isNotEmpty($this->accent);
    }




    /**
     * @param string $url
     * @return $this
     */
    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }




    /**
     * @return string
     */
    public function getUrl() {
        return $this->url;
    }




    /**
     * @return bool
     */
    public function hasUrl() {
        return Utils::isNotEmpty($this->url);
    }




    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        $results = array();

        if($this->hasAccent()) {
            $results[self::JSON_PROPERTY_ACCENT] = $this->accent;
        }

        if($this->hasUrl()) {
            $results[self::JSON_PROPERTY_URL] = $this->url;
        }

        return $results;
    }




}