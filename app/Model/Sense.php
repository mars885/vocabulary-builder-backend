<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/16/17
 * Time: 9:43 AM
 */

namespace App\Model;

use App\Utils\Utils;
use JsonSerializable;

class Sense extends BaseModel implements JsonSerializable {


    const JSON_PROPERTY_ID = 'id';
    const JSON_PROPERTY_CASED = 'cased';
    const JSON_PROPERTY_CATEGORY = 'category';
    const JSON_PROPERTY_PART_OF_SPEECH = 'part_of_speech';
    const JSON_PROPERTY_DEFINITION = 'definition';
    const JSON_PROPERTY_EXAMPLES = 'examples';
    const JSON_PROPERTY_SYNONYMS = 'synonyms';
    const JSON_PROPERTY_ANTONYMS = 'antonyms';
    const JSON_PROPERTY_DERIVATIONS = 'derivations';
    const JSON_PROPERTY_LEARNER_COUNT = 'learner_count';
    const JSON_PROPERTY_MASTER_COUNT = 'master_count';
    const JSON_PROPERTY_LIKE_COUNT = 'like_count';
    const JSON_PROPERTY_IS_LIKED = 'is_liked';


    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $cased;

    /**
     * @var string
     */
    protected $category;

    /**
     * @var string
     */
    protected $partOfSpeech;

    /**
     * @var string
     */
    protected $definition;

    /**
     * @var array
     */
    protected $examples;

    /**
     * @var array
     */
    protected $synonyms;

    /**
     * @var array
     */
    protected $antonyms;

    /**
     * @var array
     */
    protected $derivations;

    /**
     * @var int
     */
    protected $learnerCount;

    /**
     * @var int
     */
    protected $masterCount;

    /**
     * @var int
     */
    protected $likeCount;

    /**
     * @var bool|null
     */
    protected $isLiked;




    public function __construct() {
        parent::__construct();

        $this->id = -1;
        $this->cased = '';
        $this->category = '';
        $this->partOfSpeech = '';
        $this->definition = '';
        $this->examples = array();
        $this->synonyms = array();
        $this->antonyms = array();
        $this->derivations = array();
        $this->learnerCount = -1;
        $this->masterCount = -1;
        $this->likeCount = -1;
        $this->isLiked = null;
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
     * @param string $cased
     * @return $this
     */
    public function setCased($cased) {
        $this->cased = $cased;
        return $this;
    }




    /**
     * @return string
     */
    public function getCased() {
        return $this->cased;
    }




    /**
     * @return bool
     */
    public function hasCased() {
        return Utils::isNotEmpty($this->cased);
    }




    /**
     * @param string $category
     * @return $this
     */
    public function setCategory($category) {
        $this->category = $category;
        return $this;
    }




    /**
     * @return string
     */
    public function getCategory() {
        return $this->category;
    }




    /**
     * @return bool
     */
    public function hasCategory() {
        return Utils::isNotEmpty($this->category);
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
     * @param string $definition
     * @return $this
     */
    public function setDefinition($definition) {
        $this->definition = $definition;
        return $this;
    }




    /**
     * @return string
     */
    public function getDefinition() {
        return $this->definition;
    }




    /**
     * @return bool
     */
    public function hasDefinition() {
        return Utils::isNotEmpty($this->definition);
    }




    /**
     * @param array $examples
     * @return $this
     */
    public function setExamples($examples) {
        $this->examples = $examples;
        return $this;
    }




    /**
     * @return array
     */
    public function getExamples() {
        return $this->examples;
    }




    /**
     * @return bool
     */
    public function hasExamples() {
        return Utils::isNotEmpty($this->examples);
    }




    /**
     * @param array $synonyms
     * @return $this
     */
    public function setSynonyms($synonyms) {
        $this->synonyms = $synonyms;
        return $this;
    }




    /**
     * @return array
     */
    public function getSynonyms() {
        return $this->synonyms;
    }




    /**
     * @return bool
     */
    public function hasSynonyms() {
        return Utils::isNotEmpty($this->synonyms);
    }




    /**
     * @param array $antonyms
     * @return $this
     */
    public function setAntonyms($antonyms) {
        $this->antonyms = $antonyms;
        return $this;
    }




    /**
     * @return array
     */
    public function getAntonyms() {
        return $this->antonyms;
    }




    /**
     * @return bool
     */
    public function hasAntonyms() {
        return Utils::isNotEmpty($this->antonyms);
    }




    /**
     * @param array $derivations
     * @return $this
     */
    public function setDerivations($derivations) {
        $this->derivations = $derivations;
        return $this;
    }




    /**
     * @return array
     */
    public function getDerivations() {
        return $this->derivations;
    }




    /**
     * @return bool
     */
    public function hasDerivations() {
        return Utils::isNotEmpty($this->derivations);
    }




    /**
     * @param int $learnerCount
     * @return $this
     */
    public function setLearnerCount($learnerCount) {
        $this->learnerCount = $learnerCount;
        return $this;
    }




    /**
     * @return int
     */
    public function getLearnerCount() {
        return $this->learnerCount;
    }




    /**
     * @return bool
     */
    public function hasLearnerCount() {
        return ($this->learnerCount > 0);
    }




    /**
     * @param int $masterCount
     * @return $this
     */
    public function setMasterCount($masterCount) {
        $this->masterCount = $masterCount;
        return $this;
    }




    /**
     * @return int
     */
    public function getMasterCount() {
        return $this->masterCount;
    }




    /**
     * @return bool
     */
    public function hasMasterCount() {
        return ($this->masterCount > 0);
    }




    /**
     * @param int $likeCount
     * @return $this
     */
    public function setLikeCount($likeCount) {
        $this->likeCount = $likeCount;
        return $this;
    }




    /**
     * @return int
     */
    public function getLikeCount() {
        return $this->likeCount;
    }




    /**
     * @return bool
     */
    public function hasLikeCount() {
        return ($this->likeCount > 0);
    }




    /**
     * @param bool|null $isLiked
     * @return $this
     */
    public function setLiked($isLiked) {
        $this->isLiked = $isLiked;
        return $this;
    }




    /**
     * @return bool|null
     */
    public function isLiked() {
        return $this->isLiked;
    }




    /**
     * @return bool
     */
    public function hasIsLiked() {
        return Utils::isNotNull($this->isLiked);
    }




    /**
     * @inheritdoc
     */
    public function jsonSerialize() {
        $results = array();

        if($this->hasId()) {
            $results[self::JSON_PROPERTY_ID] = $this->id;
        }

        if($this->hasCased()) {
            $results[self::JSON_PROPERTY_CASED] = $this->cased;
        }

        if($this->hasCategory()) {
            $results[self::JSON_PROPERTY_CATEGORY] = $this->category;
        }

        if($this->hasPartOfSpeech()) {
            $results[self::JSON_PROPERTY_PART_OF_SPEECH] = $this->partOfSpeech;
        }

        if($this->hasDefinition()) {
            $results[self::JSON_PROPERTY_DEFINITION] = $this->definition;
        }

        if($this->hasExamples()) {
            $results[self::JSON_PROPERTY_EXAMPLES] = $this->examples;
        }

        if($this->hasSynonyms()) {
            $results[self::JSON_PROPERTY_SYNONYMS] = $this->synonyms;
        }

        if($this->hasAntonyms()) {
            $results[self::JSON_PROPERTY_ANTONYMS] = $this->antonyms;
        }

        if($this->hasDerivations()) {
            $results[self::JSON_PROPERTY_DERIVATIONS] = $this->derivations;
        }

        if($this->hasLearnerCount()) {
            $results[self::JSON_PROPERTY_LEARNER_COUNT] = $this->learnerCount;
        }

        if($this->hasMasterCount()) {
            $results[self::JSON_PROPERTY_MASTER_COUNT] = $this->masterCount;
        }

        if($this->hasLikeCount()) {
            $results[self::JSON_PROPERTY_LIKE_COUNT] = $this->likeCount;
        }

        if($this->hasIsLiked()) {
            $results[self::JSON_PROPERTY_IS_LIKED] = $this->isLiked;
        }

        return $results;
    }




}