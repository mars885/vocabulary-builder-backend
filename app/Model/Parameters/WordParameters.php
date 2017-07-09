<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/31/17
 * Time: 11:23 AM
 */

namespace App\Model\Parameters;

use App\Utils\Utils;

class WordParameters extends BaseParameters {


    /**
     * @var bool
     */
    protected $areExamplesRequired;

    /**
     * @var bool
     */
    protected $areSynonymsRequired;

    /**
     * @var bool
     */
    protected $areAntonymsRequired;

    /**
     * @var bool
     */
    protected $areDerivationsRequired;

    /**
     * @var string
     */
    protected $word;

    /**
     * @var string
     */
    protected $partOfSpeech;

    /**
     * @var CursorParameters|null
     */
    protected $cursorParameters;




    public function __construct() {
        parent::__construct();

        $this->areExamplesRequired = false;
        $this->areSynonymsRequired = false;
        $this->areAntonymsRequired = false;
        $this->areDerivationsRequired = false;
        $this->word = '';
        $this->partOfSpeech = '';
        $this->cursorParameters = null;
    }




    /**
     * @param bool $areExamplesRequired
     * @return $this
     */
    public function setExamplesRequired($areExamplesRequired) {
        $this->areExamplesRequired = $areExamplesRequired;
        return $this;
    }




    /**
     * @return bool
     */
    public function areExamplesRequired() {
        return $this->areExamplesRequired;
    }




    /**
     * @param bool $areSynonymsRequired
     * @return $this
     */
    public function setSynonymsRequired($areSynonymsRequired) {
        $this->areSynonymsRequired = $areSynonymsRequired;
        return $this;
    }




    /**
     * @return bool
     */
    public function areSynonymsRequired() {
        return $this->areSynonymsRequired;
    }




    /**
     * @param bool $areAntonymsRequired
     * @return $this
     */
    public function setAntonymsRequired($areAntonymsRequired) {
        $this->areAntonymsRequired = $areAntonymsRequired;
        return $this;
    }




    /**
     * @return bool
     */
    public function areAntonymsRequired() {
        return $this->areAntonymsRequired;
    }




    /**
     * @param bool $areDerivationsRequired
     * @return $this
     */
    public function setDerivationsRequired($areDerivationsRequired) {
        $this->areDerivationsRequired = $areDerivationsRequired;
        return $this;
    }




    /**
     * @return bool
     */
    public function areDerivationsRequired() {
        return $this->areDerivationsRequired;
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
     * @param string $partOfSpeech
     * @return $this
     */
    public function setPartOfSpeech($partOfSpeech) {
        $this->partOfSpeech = $partOfSpeech;
        return $this;
    }




    /**
     * @return string
     */
    public function getPartOfSpeech() {
        return $this->partOfSpeech;
    }




    /**
     * @return bool
     */
    public function hasPartOfSpeech() {
        return Utils::isNotEmpty($this->partOfSpeech);
    }




    /**
     * @param CursorParameters $cursorParameters
     * @return $this
     */
    public function setCursorParameters($cursorParameters) {
        $this->cursorParameters = $cursorParameters;
        return $this;
    }




    /**
     * @return CursorParameters|null
     */
    public function getCursorParameters() {
        return $this->cursorParameters;
    }




    /**
     * @return bool
     */
    public function hasCursorParameters() {
        return Utils::isNotNull($this->cursorParameters);
    }




}