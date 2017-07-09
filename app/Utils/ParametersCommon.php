<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/29/17
 * Time: 1:14 AM
 */

namespace App\Utils;

use App\Exceptions\BadRequestException;
use App\Exceptions\InternalServerException;
use App\Model\Constants\Delimiters;
use App\Model\Constants\ParameterTypes;
use App\Model\Constants\RequestParameters\CursorRequestParameters;
use App\Model\Constants\RequestParameters\GeneralRequestParameters;
use App\Model\Constants\RequestParameters\UserRequestParameters;
use App\Model\Constants\RequestParameters\WordRequestParameters;
use App\Model\Cursor;
use App\Model\Parameters\CursorParameters;
use App\Model\Parameters\UserParameters;
use App\Model\Parameters\WordParameters;
use Slim\Http\Request;

abstract class ParametersCommon {




    /**
     * @param string $type
     * @param Request $request
     * @param string $key
     * @param mixed $default
     *
     * @return string
     */
    public static function getParameter($type, $request, $key, $default = null) {
        if(Utils::isInvalid($type) || Utils::isNull($request) || Utils::isInvalid($key)) {
            return '';
        }

        switch($type) {

        case ParameterTypes::QUERY:
            return $request->getQueryParam($key, $default);

        case ParameterTypes::PARSED_BODY:
            return $request->getParsedBodyParam($key, $default);

        case ParameterTypes::ATTRIBUTE:
            return $request->getAttribute($key, $default);

        default:
            return $default;

        }
    }




    /**
     * @param string $type
     * @param string $parameter
     * @param string|null $hint
     *
     * @throws BadRequestException
     * @throws InternalServerException
     */
    private static function throwExceptionForType($type, $parameter, $hint = null) {
        switch($type) {

        case ParameterTypes::QUERY:
        case ParameterTypes::PARSED_BODY:
            throw BadRequestException::invalidParameter($parameter, $hint);

        case ParameterTypes::ATTRIBUTE:
            throw InternalServerException::serverError('Could not fetch `' . $parameter . '` attribute.');
        }
    }




    /**
     * @param string $type
     * @param Request $request
     * @param mixed $default
     * @param bool $required
     *
     * @return mixed
     */
    public static function getUserIdParameter($type, $request, $default = null, $required = true) {
        // Fetching the parameter
        $userId = self::getParameter($type, $request, GeneralRequestParameters::USER_ID, $default);

        // Checking for optionality
        if(!$required && ($userId === $default)) {
            return $default;
        }

        // Performing validation
        if(!TypeRecognizer::isInteger($userId)) {
            self::throwExceptionForType($type, GeneralRequestParameters::USER_ID);
        }

        // Returning sanitized parameter
        return TypeConverter::toInteger($userId);
    }




    /**
     * @param string $type
     * @param Request $request
     * @param mixed $default
     * @param bool $required
     *
     * @return mixed
     */
    public static function getIsClientFirstPartyParameter($type, $request, $default = null, $required = true) {
        $isClientFirstParty = self::getParameter($type, $request, GeneralRequestParameters::IS_CLIENT_FIRST_PARTY, $default);

        // Checking for optionality
        if(!$required && ($isClientFirstParty === $default)) {
            return $default;
        }

        // Performing validation
        if(!TypeRecognizer::isBoolean($isClientFirstParty)) {
            self::throwExceptionForType($type, GeneralRequestParameters::IS_CLIENT_FIRST_PARTY);
        }

        // Returning sanitized parameter
        return TypeConverter::toBoolean($isClientFirstParty);
    }




    /**
     * @param string $type
     * @param Request $request
     * @param mixed $default
     * @param bool $required
     *
     * @return mixed
     */
    public static function getWordParameter($type, $request, $default = null, $required = true) {
        $word = self::getParameter($type, $request, WordRequestParameters::WORD, $default);

        // Checking for optionality
        if(!$required && ($word === $default)) {
            return $default;
        }

        // Performing validation
        if(!TypeRecognizer::isString($word) || Utils::isEmpty($word = StringUtils::trim($word))) {
            self::throwExceptionForType($type, WordRequestParameters::WORD);
        }

        // Returning sanitized parameter
        return StringUtils::toLowerCase(TypeConverter::toString($word));
    }




    /**
     * @param string $type
     * @param Request $request
     * @param mixed $default
     * @param bool $required
     *
     * @return mixed
     */
    public static function getPartOfSpeechParameter($type, $request, $default = null, $required = true) {
        $partOfSpeech = self::getParameter($type, $request, WordRequestParameters::PART_OF_SPEECH, $default);

        // Checking for optionality
        if(!$required && ($partOfSpeech === $default)) {
            return $partOfSpeech;
        }

        // Performing validation
        if(!TypeRecognizer::isString($partOfSpeech) || Utils::isEmpty($partOfSpeech = StringUtils::trim($partOfSpeech))) {
            self::throwExceptionForType($type, WordRequestParameters::PART_OF_SPEECH);
        }

        // Returning sanitized parameter
        return StringUtils::toLowerCase(TypeConverter::toString($partOfSpeech));
    }




    /**
     * @param string $type
     * @param Request $request
     * @param mixed $default
     * @param bool $required
     *
     * @return mixed
     */
    public static function getExamplesRequiredParameter($type, $request, $default = null, $required = true) {
        $areExamplesRequired = self::getParameter($type, $request, WordRequestParameters::EXAMPLES_REQUIRED, $default);

        // Checking for optionality
        if(!$required && ($areExamplesRequired === $default)) {
            return $default;
        }

        // Performing validation
        if(!TypeRecognizer::isBoolean($areExamplesRequired)) {
            self::throwExceptionForType($type, WordRequestParameters::EXAMPLES_REQUIRED);
        }

        // Returning sanitized parameter
        return TypeConverter::toBoolean($areExamplesRequired);
    }




    /**
     * @param string $type
     * @param Request $request
     * @param mixed $default
     * @param bool $required
     *
     * @return mixed
     */
    public static function getSynonymsRequiredParameter($type, $request, $default = null, $required = true) {
        $areSynonymsRequired = self::getParameter($type, $request, WordRequestParameters::SYNONYMS_REQUIRED, $default);

        // Checking for optionality
        if(!$required && ($areSynonymsRequired === $default)) {
            return $default;
        }

        // Performing validation
        if(!TypeRecognizer::isBoolean($areSynonymsRequired)) {
            self::throwExceptionForType($type, WordRequestParameters::SYNONYMS_REQUIRED);
        }

        // Returning sanitized parameter
        return TypeConverter::toBoolean($areSynonymsRequired);
    }




    /**
     * @param string $type
     * @param Request $request
     * @param mixed $default
     * @param bool $required
     *
     * @return mixed
     */
    public static function getAntonymsRequiredParameter($type, $request, $default = null, $required = true) {
        $areAntonymsRequired = self::getParameter($type, $request, WordRequestParameters::ANTONYMS_REQUIRED, $default);

        // Checking for optionality
        if(!$required && ($areAntonymsRequired === $default)) {
            return $default;
        }

        // Performing validation
        if(!TypeRecognizer::isBoolean($areAntonymsRequired)) {
            self::throwExceptionForType($type, WordRequestParameters::ANTONYMS_REQUIRED);
        }

        // Returning sanitized parameter
        return TypeConverter::toBoolean($areAntonymsRequired);
    }




    /**
     * @param string $type
     * @param Request $request
     * @param mixed $default
     * @param bool $required
     *
     * @return mixed
     */
    public static function getDerivationsRequiredParameter($type, $request, $default = null, $required = true) {
        $areDerivationsRequired = self::getParameter($type, $request, WordRequestParameters::DERIVATIONS_REQUIRED, $default);

        // Checking for optionality
        if(!$required && ($areDerivationsRequired === $default)) {
            return $default;
        }

        // Performing validation
        if(!TypeRecognizer::isBoolean($areDerivationsRequired)) {
            self::throwExceptionForType($type, WordRequestParameters::DERIVATIONS_REQUIRED);
        }

        // Returning sanitized parameter
        return TypeConverter::toBoolean($areDerivationsRequired);
    }




    /**
     * @param string $type
     * @param Request $request
     * @param mixed $default
     * @param bool $required
     *
     * @return mixed
     */
    public static function getQueryParameter($type, $request, $default = null, $required = true) {
        $query = self::getParameter($type, $request, 'query', $default);

        // Checking for optionality
        if(!$required && ($query === $default)) {
            return $default;
        }

        // Performing validation
        if(!TypeRecognizer::isString($query)) {
            self::throwExceptionForType($type, 'query');
        }

        // Returning sanitized parameter
        return TypeConverter::toString($query);
    }




    /**
     * @param string $type
     * @param Request $request
     * @param mixed $default
     * @param bool
     *
     * @return mixed
     */
    public static function getUserIdsParameter($type, $request, $default = null, $required = true) {
        $userIdsStr = self::getParameter($type, $request, UserRequestParameters::USER_IDS, $default);

        // Checking for optionality
        if(!$required && ($userIdsStr === $default)) {
            return $default;
        }

        // Splitting the ids string into an array
        $userIds = ArrayUtils::explode(Delimiters::DELIMITER_USER_IDS, $userIdsStr);

        // Validating the split
        if(Utils::isEmpty($userIds)) {
            self::throwExceptionForType($type, UserRequestParameters::USER_IDS);
        }

        // Filtering the ids
        foreach($userIds as $index => $userId) {
            if(!TypeRecognizer::isInteger($userId)) {
                self::throwExceptionForType($type, UserRequestParameters::USER_IDS);
            }

            $ids[$index] = TypeConverter::toInteger($userId);
        }

        // Checking the size
        if(ArrayUtils::getSize($userIds) > 100) {
            self::throwExceptionForType($type, UserRequestParameters::USER_IDS);
        }

        return $ids;
    }




    /**
     * @param string $type
     * @param Request $request
     * @param array $paginationConfig
     * @param mixed $default
     * @param bool $required
     *
     * @return mixed
     */
    public static function getLimitParameter($type, $request, $paginationConfig, $default = null, $required = true) {
        $limit = self::getParameter($type, $request, CursorRequestParameters::LIMIT, $default);

        // Checking for optionality
        if(!$required && ($limit === $default)) {
            return $default;
        }

        // Performing validation
        if(TypeRecognizer::isInteger($limit)) {
            $limit = TypeConverter::toInteger($limit);
            $minLimit = $paginationConfig['min_limit'];
            $maxLimit = $paginationConfig['max_limit'];

            // Returning sanitized parameter
            if(($limit >= $minLimit) && ($limit <= $maxLimit)) {
                return $limit;
            }
        }

        self::throwExceptionForType($type, CursorRequestParameters::LIMIT);
    }




    /**
     * @param string $type
     * @param Request $request
     * @param mixed $default
     * @param bool $required
     *
     * @return mixed
     */
    public static function getNextCursorParameter($type, $request, $default = null, $required = true) {
        $encodedNextCursor = self::getParameter($type, $request, CursorRequestParameters::NEXT, $default);

        // Checking for optionality
        if(!$required && ($encodedNextCursor === $default)) {
            return $default;
        }

        // Performing validation
        if(TypeRecognizer::isString($encodedNextCursor)) {
            // Returning sanitized parameter
            if(Utils::isNotNull($cursor = CursorUtils::parseCursor(TypeConverter::toString($encodedNextCursor)))) {
                return $cursor->setType(Cursor::TYPE_NEXT);
            }
        }

        self::throwExceptionForType($type, CursorRequestParameters::NEXT);
    }




    /**
     * @param string $type
     * @param Request $request
     * @param mixed $default
     * @param bool $required
     *
     * @return mixed
     */
    public static function getPreviousCursorParameter($type, $request, $default = null, $required = true) {
        $encodedPreviousCursor = self::getParameter($type, $request, CursorRequestParameters::PREVIOUS, $default);

        // Checking for optionality
        if(!$required && ($encodedPreviousCursor === $default)) {
            return $default;
        }

        // Performing validation
        if(TypeRecognizer::isString($encodedPreviousCursor)) {
            // Returning sanitized parameter
            if(Utils::isNotNull($cursor = CursorUtils::parseCursor(TypeConverter::toString($encodedPreviousCursor)))) {
                return $cursor->setType(Cursor::TYPE_PREVIOUS);
            }
        }

        self::throwExceptionForType($type, CursorRequestParameters::PREVIOUS);
    }




    /**
     * @param Request $request
     * @param array $config
     *
     * @return CursorParameters
     */
    public static function getCursorParameters($request, $config) {
        $parameters = new CursorParameters();

        // Fetching necessary parameters
        $parameters->setLimit(self::getLimitParameter(ParameterTypes::QUERY, $request, $config['pagination'], $config['pagination']['default_limit']));
        $parameters->setNextCursor(self::getNextCursorParameter(ParameterTypes::QUERY, $request, null, false));
        $parameters->setPreviousCursor(self::getPreviousCursorParameter(ParameterTypes::QUERY, $request, null, false));

        return $parameters;
    }




    /**
     * @param Request $request
     *
     * @return UserParameters
     */
    public static function getParametersForVerifyingCredentials($request) {
        $parameters = new UserParameters();

        // Fetching necessary parameters
        $parameters->setAuthUserId(self::getUserIdParameter(ParameterTypes::ATTRIBUTE, $request));
        $parameters->setClientFirstParty(self::getIsClientFirstPartyParameter(ParameterTypes::ATTRIBUTE, $request));

        return $parameters;
    }




    /**
     * @param Request $request
     *
     * @return WordParameters
     */
    public static function getParametersForWordsSearch($request) {
        $parameters = new WordParameters();

        // Fetching necessary parameters
        $parameters->setAuthUserId(self::getUserIdParameter(ParameterTypes::ATTRIBUTE, $request));
        $parameters->setWord(self::getWordParameter(ParameterTypes::QUERY, $request));
        $parameters->setPartOfSpeech(self::getPartOfSpeechParameter(ParameterTypes::QUERY, $request, '', false));
        $parameters->setExamplesRequired(self::getExamplesRequiredParameter(ParameterTypes::QUERY, $request, false, false));
        $parameters->setSynonymsRequired(self::getSynonymsRequiredParameter(ParameterTypes::QUERY, $request, false, false));
        $parameters->setAntonymsRequired(self::getAntonymsRequiredParameter(ParameterTypes::QUERY, $request, false, false));
        $parameters->setDerivationsRequired(self::getDerivationsRequiredParameter(ParameterTypes::QUERY, $request, false, false));

        return $parameters;
    }




    /**
     * @param Request $request
     * @param array $config
     *
     * @return UserParameters
     */
    public static function getParametersForUsersSearch($request, $config) {
        $parameters = new UserParameters();

        // Fetching necessary parameters
        $parameters->setAuthUserId(self::getUserIdParameter(ParameterTypes::ATTRIBUTE, $request));
        $parameters->setQuery(self::getQueryParameter(ParameterTypes::QUERY, $request));
        $parameters->setCursorParameters(self::getCursorParameters($request, $config));

        return $parameters;
    }




    /**
     * @param Request $request
     *
     * @return UserParameters
     */
    public static function getParametersForLookingUpUserById($request) {
        $parameters = new UserParameters();

        // Fetching the necessary parameters
        $parameters->setUserId(self::getUserIdParameter(ParameterTypes::QUERY, $request));
        $parameters->setAuthUserId(self::getUserIdParameter(ParameterTypes::ATTRIBUTE, $request));

        return $parameters;
    }




    /**
     * @param Request $request
     *
     * @return UserParameters
     */
    public static function getParametersForLookingUpUsersByIds($request) {
        $parameters = new UserParameters();

        // Fetching the necessary parameters
        $parameters->setUserIds(self::getUserIdsParameter(ParameterTypes::QUERY, $request));
        $parameters->setAuthUserId(self::getUserIdParameter(ParameterTypes::ATTRIBUTE, $request));

        return $parameters;
    }




    /**
     * @param Request $request
     *
     * @return UserParameters
     */
    public static function getParametersForFollowingUser($request) {
        $parameters = new UserParameters();

        // Fetching necessary parameters
        $parameters->setUserId(self::getUserIdParameter(ParameterTypes::PARSED_BODY, $request));
        $parameters->setAuthUserId(self::getUserIdParameter(ParameterTypes::ATTRIBUTE, $request));

        // Checking whether the provided user_id does not equal auth_user_id
        if($parameters->getUserId() === $parameters->getAuthUserId()) {
            self::throwExceptionForType(ParameterTypes::PARSED_BODY, GeneralRequestParameters::USER_ID);
        }

        return $parameters;
    }




    /**
     * @param Request $request
     *
     * @return UserParameters
     */
    public static function getParametersForUnfollowingUser($request) {
        $parameters = new UserParameters();

        // Fetching necessary parameters
        $parameters->setUserId(self::getUserIdParameter(ParameterTypes::PARSED_BODY, $request));
        $parameters->setAuthUserId(self::getUserIdParameter(ParameterTypes::ATTRIBUTE, $request));

        // Checking whether the provided user_id does not equal auth_user_id
        if($parameters->getUserId() === $parameters->getAuthUserId()) {
            self::throwExceptionForType(ParameterTypes::PARSED_BODY, GeneralRequestParameters::USER_ID);
        }

        return $parameters;
    }




    /**
     * @param Request $request
     * @param array $config
     *
     * @return UserParameters
     */
    public static function getParametersForFriendsIds($request, $config) {
        $parameters = new UserParameters();

        // Fetching necessary parameters
        $parameters->setUserId(self::getUserIdParameter(ParameterTypes::QUERY, $request, $request->getAttribute(GeneralRequestParameters::USER_ID)));
        $parameters->setCursorParameters(self::getCursorParameters($request, $config));

        return $parameters;
    }




    /**
     * @param Request $request
     * @param array $config
     *
     * @return UserParameters
     */
    public static function getParametersForFriendsList($request, $config) {
        $parameters = new UserParameters();

        // Fetching necessary parameters
        $parameters->setUserId(self::getUserIdParameter(ParameterTypes::QUERY, $request, $request->getAttribute(GeneralRequestParameters::USER_ID)));
        $parameters->setCursorParameters(self::getCursorParameters($request, $config));

        return $parameters;
    }




    /**
     * @param Request $request
     * @param array $config
     *
     * @return UserParameters
     */
    public static function getParametersForFollowersIds($request, $config) {
        $parameters = new UserParameters();

        // Fetching necessary parameters
        $parameters->setUserId(self::getUserIdParameter(ParameterTypes::QUERY, $request, $request->getAttribute(GeneralRequestParameters::USER_ID)));
        $parameters->setCursorParameters(self::getCursorParameters($request, $config));

        return $parameters;
    }




    /**
     * @param Request $request
     * @param array $config
     *
     * @return UserParameters
     */
    public static function getParametersForFollowersList($request, $config) {
        $parameters = new UserParameters();

        // Fetching necessary parameters
        $parameters->setUserId(self::getUserIdParameter(ParameterTypes::QUERY, $request, $request->getAttribute(GeneralRequestParameters::USER_ID)));
        $parameters->setCursorParameters(self::getCursorParameters($request, $config));

        return $parameters;
    }




}