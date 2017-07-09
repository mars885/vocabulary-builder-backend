<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 11/26/17
 * Time: 4:33 PM
 */

namespace App\Model\Constants;

abstract class OAuthScopeDomains {


    const EMAIL_ID = 1;
    const EMAIL = 'email';

    const PASSWORD_ID = 2;
    const PASSWORD = 'password';

    const USERS_ID = 3;
    const USERS = 'users';

    const WORDS_ID = 4;
    const WORDS = 'words';

    const QUIZZES_ID = 5;
    const QUIZZES = 'quizzes';




    /**
     * @return array
     */
    public static function getAsArray() {
        return [
            [
                self::EMAIL_ID,
                self::EMAIL
            ],
            [
                self::PASSWORD_ID,
                self::PASSWORD
            ],
            [
                self::USERS_ID,
                self::USERS
            ],
            [
                self::WORDS_ID,
                self::WORDS
            ],
            [
                self::QUIZZES_ID,
                self::QUIZZES
            ]
        ];
    }




    /**
     * @return array
     */
    public static function getIdsAsArray() {
        return [
            self::EMAIL_ID,
            self::PASSWORD_ID,
            self::USERS_ID,
            self::WORDS_ID,
            self::QUIZZES_ID
        ];
    }




    /**
     * @return array
     */
    public static function getDomainsAsArray() {
        return [
            self::EMAIL,
            self::PASSWORD,
            self::USERS,
            self::WORDS,
            self::QUIZZES
        ];
    }




}