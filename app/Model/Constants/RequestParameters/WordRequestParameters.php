<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 1/10/18
 * Time: 7:14 PM
 */

namespace App\Model\Constants\RequestParameters;

abstract class WordRequestParameters {


    const WORD = 'word';
    const PART_OF_SPEECH = 'part_of_speech';

    const EXAMPLES_REQUIRED = 'examples_required';
    const SYNONYMS_REQUIRED = 'synonyms_required';
    const ANTONYMS_REQUIRED = 'antonyms_required';
    const DERIVATIONS_REQUIRED = 'derivations_required';


}