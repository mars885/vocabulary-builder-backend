<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 7/13/17
 * Time: 2:29 AM
 */

namespace App\Model;

use App\Utils\Utils;
use JsonSerializable;

class Word implements JsonSerializable {


    const JSON_PROPERTY_ID = 'id';
    const JSON_PROPERTY_WORD = 'word';
    const JSON_PROPERTY_PRONUNCIATIONS = 'pronunciations';
    const JSON_PROPERTY_SENSES = 'senses';


    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $word;

    /**
     * @var array
     */
    protected $pronunciations;

    /**
     * @var array
     */
    protected $senses;




    public function __construct() {
        $this->id = -1;
        $this->word = '';
        $this->pronunciations = array();
        $this->senses = array();
    }




    /**
     * @param int $id
     * @return $this
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }




    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }




    /**
     * @return bool
     */
    public function hasId() {
        return ($this->id > 0);
    }




    /**
     * @param string $word
     * @return $this
     */
    public function setWord($word) {
        $this->word = $word;
        return $this;
    }




    /**
     * @return string
     */
    public function getWord() {
        return $this->word;
    }




    /**
     * @return bool
     */
    public function hasWord() {
        return Utils::isNotEmpty($this->word);
    }




    /**
     * @param array $pronunciations
     * @return $this
     */
    public function setPronunciations($pronunciations) {
        $this->pronunciations = $pronunciations;
        return $this;
    }




    /**
     * @return array
     */
    public function getPronunciations() {
        return $this->pronunciations;
    }




    /**
     * @return bool
     */
    public function hasPronunciations() {
        return Utils::isNotEmpty($this->pronunciations);
    }




    /**
     * @param array $senses
     * @return $this
     */
    public function setSenses($senses) {
        $this->senses = $senses;
        return $this;
    }




    /**
     * @return array
     */
    public function getSenses() {
        return $this->senses;
    }




    /**
     * @return bool
     */
    public function hasSenses() {
        return Utils::isNotEmpty($this->senses);
    }




    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        $results = array();

        if($this->hasId()) {
            $results[self::JSON_PROPERTY_ID] = $this->id;
        }

        if($this->hasWord()) {
            $results[self::JSON_PROPERTY_WORD] = $this->word;
        }

        if($this->hasPronunciations()) {
            $results[self::JSON_PROPERTY_PRONUNCIATIONS] = $this->pronunciations;
        }

        if($this->hasSenses()) {
            $results[self::JSON_PROPERTY_SENSES] = $this->senses;
        }

        return $results;
    }




}