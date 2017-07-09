<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/29/17
 * Time: 10:35 PM
 */

namespace App\Database\Queries;

use App\Database\Schemas\Tables\DictionaryTable;
use App\Database\Schemas\Tables\FollowersTable;
use App\Database\Schemas\Tables\OAuthAccessTokensTable;
use App\Database\Schemas\Tables\OAuthClientEndpointsTable;
use App\Database\Schemas\Tables\OAuthClientGrantTypesTable;
use App\Database\Schemas\Tables\OAuthClientScopesTable;
use App\Database\Schemas\Tables\OAuthClientsTable;
use App\Database\Schemas\Tables\OAuthClientTypesTable;
use App\Database\Schemas\Tables\OAuthGrantTypeScopesTable;
use App\Database\Schemas\Tables\OAuthGrantTypesTable;
use App\Database\Schemas\Tables\OAuthOwnerTypesTable;
use App\Database\Schemas\Tables\OAuthRefreshTokensTable;
use App\Database\Schemas\Tables\OAuthScopeDomainsTable;
use App\Database\Schemas\Tables\OAuthScopePermissionsTable;
use App\Database\Schemas\Tables\OAuthScopesTable;
use App\Database\Schemas\Tables\PartsOfSpeechTable;
use App\Database\Schemas\Tables\SynonymSetsTable;
use App\Database\Schemas\Tables\UserDictionaryEntriesTable;
use App\Database\Schemas\Tables\UserLikedDictionaryEntriesTable;
use App\Database\Schemas\Tables\UsersTable;
use App\Database\Schemas\Tables\WordCategoriesTable;
use App\Database\Schemas\Tables\WordsTable;
use App\Database\Utils\QueryUtil;

abstract class TableQueries {


    

    /**
     * @return string
     */
    public static function getUsersTableCreationQuery() {
        return
            'CREATE TABLE ' . UsersTable::TABLE_NAME . ' ('
            . UsersTable::ID . ' ' . UsersTable::ID_DATA_TYPE . ' NOT NULL AUTO_INCREMENT, '
            . UsersTable::USER_NAME . ' ' . UsersTable::USER_NAME_DATA_TYPE . ' NOT NULL, '
            . UsersTable::FULL_NAME . ' ' . UsersTable::FULL_NAME_DATA_TYPE . ' NOT NULL, '
            . UsersTable::EMAIL . ' ' . UsersTable::EMAIL_DATA_TYPE . ' NOT NULL, '
            . UsersTable::PASSWORD . ' ' . UsersTable::PASSWORD_DATA_TYPE . ' NOT NULL, '
            . UsersTable::FRIEND_COUNT . ' ' . UsersTable::FRIEND_COUNT_DATA_TYPE . ' NOT NULL DEFAULT 0, '
            . UsersTable::FOLLOWER_COUNT . ' ' . UsersTable::FOLLOWER_COUNT_DATA_TYPE . ' NOT NULL DEFAULT 0, '
            . UsersTable::IS_ACTIVATED . ' ' . UsersTable::IS_ACTIVATED_DATA_TYPE . ' NOT NULL DEFAULT 0, '
            . UsersTable::ACTIVATION_TOKEN . ' ' . UsersTable::ACTIVATION_TOKEN_DATA_TYPE . ' NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . UsersTable::ID . '), '
            . 'UNIQUE KEY (' . UsersTable::USER_NAME . '), '
            . 'UNIQUE KEY (' . UsersTable::EMAIL . '), '
            . 'UNIQUE KEY (' . UsersTable::ACTIVATION_TOKEN . ')) '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getUsersTableDeletionQuery() {
        return 'DROP TABLE ' . UsersTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getFollowersTableCreationQuery() {
        return
            'CREATE TABLE ' . FollowersTable::TABLE_NAME . ' ('
            . FollowersTable::FOLLOWER_ID . ' ' . FollowersTable::FOLLOWER_ID_DATA_TYPE . ' NOT NULL, '
            . FollowersTable::FRIEND_ID . ' ' . FollowersTable::FRIEND_ID_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . FollowersTable::FOLLOWER_ID . ', ' . FollowersTable::FRIEND_ID . '), '
            . 'FOREIGN KEY (' . FollowersTable::FOLLOWER_ID . ') REFERENCES ' . UsersTable::TABLE_NAME . ' ('
            . UsersTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ', '
            . 'FOREIGN KEY (' . FollowersTable::FRIEND_ID . ') REFERENCES ' . UsersTable::TABLE_NAME . ' ('
            . UsersTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ') '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getFollowersTableDeletionQuery() {
        return 'DROP TABLE ' . FollowersTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getWordsTableCreationQuery() {
        return
            'CREATE TABLE ' . WordsTable::TABLE_NAME . ' ('
            . WordsTable::ID . ' ' . WordsTable::ID_DATA_TYPE . ' NOT NULL AUTO_INCREMENT, '
            . WordsTable::WORD . ' ' . WordsTable::WORD_DATA_TYPE . ' NOT NULL, '
            . WordsTable::AUDIO_FILE_PATH . ' ' . WordsTable::AUDIO_FILE_PATH_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . WordsTable::ID . '), '
            . 'UNIQUE KEY (' . WordsTable::WORD . ')) '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getWordsTableTruncationQuery() {
        return 'TRUNCATE TABLE ' . WordsTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getWordsTableDeletionQuery() {
        return 'DROP TABLE ' . WordsTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getPartsOfSpeechTableCreationQuery() {
        return
            'CREATE TABLE ' . PartsOfSpeechTable::TABLE_NAME . ' ('
            . PartsOfSpeechTable::ID . ' ' . PartsOfSpeechTable::ID_DATA_TYPE . ' NOT NULL AUTO_INCREMENT, '
            . PartsOfSpeechTable::PART_OF_SPEECH . ' ' . PartsOfSpeechTable::PART_OF_SPEECH_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . PartsOfSpeechTable::ID . ')) '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getPartsOfSpeechTableTruncationQuery() {
        return 'TRUNCATE TABLE ' . PartsOfSpeechTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getPartsOfSpeechTableDeletionQuery() {
        return 'DROP TABLE ' . PartsOfSpeechTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getSynonymSetsTableCreationQuery() {
        return
            'CREATE TABLE ' . SynonymSetsTable::TABLE_NAME . ' ('
            . SynonymSetsTable::ID . ' ' . WordsTable::ID_DATA_TYPE . ' NOT NULL AUTO_INCREMENT, '
            . SynonymSetsTable::PART_OF_SPEECH_ID . ' ' . SynonymSetsTable::PART_OF_SPEECH_ID_DATA_TYPE . ' NOT NULL, '
            . SynonymSetsTable::DEFINITION . ' ' . SynonymSetsTable::DEFINITION_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . SynonymSetsTable::ID . '), '
            . 'FOREIGN KEY (' . SynonymSetsTable::PART_OF_SPEECH_ID . ') REFERENCES ' . PartsOfSpeechTable::TABLE_NAME . ' ('
            . PartsOfSpeechTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ') '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getSynonymSetsTableTruncationQuery() {
        return 'TRUNCATE TABLE ' . SynonymSetsTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getSynonymSetsTableDeletionQuery() {
        return 'DROP TABLE ' . SynonymSetsTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getWordCategoriesTableCreationQuery() {
        return
            'CREATE TABLE ' . WordCategoriesTable::TABLE_NAME . ' ('
            . WordCategoriesTable::ID . ' ' . WordCategoriesTable::ID_DATA_TYPE . ' NOT NULL AUTO_INCREMENT, '
            . WordCategoriesTable::CATEGORY . ' ' . WordCategoriesTable::CATEGORY_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . WordCategoriesTable::ID . ')) '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getWordCategoriesTableTruncationQuery() {
        return 'TRUNCATE TABLE ' . WordCategoriesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getWordCategoriesTableDeletionQuery() {
        return 'DROP TABLE ' . WordCategoriesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthOwnerTypesTableCreationQuery() {
        return
            'CREATE TABLE ' . OAuthOwnerTypesTable::TABLE_NAME . ' ('
            . OAuthOwnerTypesTable::ID . ' ' . OAuthOwnerTypesTable::ID_DATA_TYPE . ' NOT NULL AUTO_INCREMENT, '
            . OAuthOwnerTypesTable::TYPE . ' ' . OAuthOwnerTypesTable::TYPE_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . OAuthOwnerTypesTable::ID . ')) '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getOAuthOwnerTypesTableTruncationQuery() {
        return 'TRUNCATE TABLE ' . OAuthOwnerTypesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthOwnerTypesTableDeletionQuery() {
        return 'DROP TABLE ' . OAuthOwnerTypesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthScopePermissionsTableCreationQuery() {
        return
            'CREATE TABLE ' . OAuthScopePermissionsTable::TABLE_NAME . ' ('
            . OAuthScopePermissionsTable::ID . ' ' . OAuthScopePermissionsTable::ID_DATA_TYPE . ' NOT NULL AUTO_INCREMENT, '
            . OAuthScopePermissionsTable::PERMISSION . ' ' . OAuthScopePermissionsTable::PERMISSION_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . OAuthScopePermissionsTable::ID . ')) '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getOAuthScopePermissionsTableTruncationQuery() {
        return 'TRUNCATE TABLE ' . OAuthScopePermissionsTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthScopePermissionsTableDeletionQuery() {
        return 'DROP TABLE ' . OAuthScopePermissionsTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthScopeDomainsTableCreationQuery() {
        return
            'CREATE TABLE ' . OAuthScopeDomainsTable::TABLE_NAME . ' ('
            . OAuthScopeDomainsTable::ID . ' ' . OAuthScopeDomainsTable::ID_DATA_TYPE . ' NOT NULL AUTO_INCREMENT, '
            . OAuthScopeDomainsTable::DOMAIN . ' ' . OAuthScopeDomainsTable::DOMAIN_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . OAuthScopeDomainsTable::ID . ')) '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getOAuthScopeDomainsTableTruncationQuery() {
        return 'TRUNCATE TABLE ' . OAuthScopeDomainsTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthScopeDomainsTableDeletionQuery() {
        return 'DROP TABLE ' . OAuthScopeDomainsTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthScopesTableCreationQuery() {
        return
            'CREATE TABLE ' . OAuthScopesTable::TABLE_NAME . ' ('
            . OAuthScopesTable::ID . ' ' . OAuthScopesTable::ID_DATA_TYPE . ' NOT NULL AUTO_INCREMENT, '
            . OAuthScopesTable::PERMISSION_ID . ' ' . OAuthScopesTable::PERMISSION_ID_DATA_TYPE . ' NOT NULL, '
            . OAuthScopesTable::DOMAIN_ID . ' ' . OAuthScopesTable::DOMAIN_ID_DATA_TYPE . ' NOT NULL, '
            . OAuthScopesTable::DESCRIPTION . ' ' . OAuthScopesTable::DESCRIPTION_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . OAuthScopesTable::ID . '), '
            . 'FOREIGN KEY (' . OAuthScopesTable::PERMISSION_ID . ') REFERENCES ' . OAuthScopePermissionsTable::TABLE_NAME . '('
            . OAuthScopePermissionsTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ', '
            . 'FOREIGN KEY (' . OAuthScopesTable::DOMAIN_ID . ') REFERENCES ' . OAuthScopeDomainsTable::TABLE_NAME . '('
            . OAuthScopeDomainsTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ') '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getOAuthScopesTableTruncationQuery() {
        return 'TRUNCATE TABLE ' . OAuthScopesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthScopesTableDeletionQuery() {
        return 'DROP TABLE ' . OAuthScopesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthGrantTypesTableCreationQuery() {
        return
            'CREATE TABLE ' . OAuthGrantTypesTable::TABLE_NAME . ' ('
            . OAuthGrantTypesTable::ID . ' ' . OAuthGrantTypesTable::ID_DATA_TYPE . ' NOT NULL AUTO_INCREMENT, '
            . OAuthGrantTypesTable::TYPE . ' ' . OAuthGrantTypesTable::TYPE_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . OAuthGrantTypesTable::ID . ')) '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getOAuthGrantTypesTableTruncationQuery() {
        return 'TRUNCATE TABLE ' . OAuthGrantTypesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthGrantTypesTableDeletionQuery() {
        return 'DROP TABLE ' . OAuthGrantTypesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthClientTypesTableCreationQuery() {
        return
            'CREATE TABLE ' . OAuthClientTypesTable::TABLE_NAME . ' ('
            . OAuthClientTypesTable::ID . ' ' . OAuthClientTypesTable::ID_DATA_TYPE . ' NOT NULL AUTO_INCREMENT, '
            . OAuthClientTypesTable::TYPE . ' ' . OAuthClientTypesTable::TYPE_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . OAuthClientTypesTable::ID . ')) '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getOAuthClientTypesTableTruncationQuery() {
        return 'TRUNCATE TABLE ' . OAuthClientTypesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthClientTypesTableDeletionQuery() {
        return 'DROP TABLE ' . OAuthClientTypesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthGrantTypeScopesTableCreationQuery() {
        return
            'CREATE TABLE ' . OAuthGrantTypeScopesTable::TABLE_NAME . ' ('
            . OAuthGrantTypeScopesTable::GRANT_TYPE_ID . ' ' . OAuthGrantTypeScopesTable::GRANT_TYPE_ID_DATA_TYPE . ' NOT NULL, '
            . OAuthGrantTypeScopesTable::SCOPE_ID . ' ' . OAuthGrantTypeScopesTable::SCOPE_ID_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . OAuthGrantTypeScopesTable::GRANT_TYPE_ID . ', ' . OAuthGrantTypeScopesTable::SCOPE_ID . '), '
            . 'FOREIGN KEY (' . OAuthGrantTypeScopesTable::GRANT_TYPE_ID . ') REFERENCES ' . OAuthGrantTypesTable::TABLE_NAME . ' ('
            . OAuthGrantTypesTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ', '
            . 'FOREIGN KEY (' . OAuthGrantTypeScopesTable::SCOPE_ID . ') REFERENCES ' . OAuthScopesTable::TABLE_NAME . ' ('
            . OAuthScopesTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ') '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getOAuthGrantTypeScopesTableTruncationQuery() {
        return 'TRUNCATE TABLE ' . OAuthGrantTypeScopesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthGrantTypeScopesTableDeletionQuery() {
        return 'DROP TABLE ' . OAuthGrantTypeScopesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthClientsTableCreationQuery() {
        return
            'CREATE TABLE ' . OAuthClientsTable::TABLE_NAME . ' ('
            . OAuthClientsTable::ID . ' ' . OAuthClientsTable::ID_DATA_TYPE . ' NOT NULL, '
            . OAuthClientsTable::SECRET . ' ' . OAuthClientsTable::SECRET_DATA_TYPE . ' NOT NULL, '
            . OAuthClientsTable::CLIENT_TYPE_ID . ' ' . OAuthClientsTable::CLIENT_TYPE_ID_DATA_TYPE . ' NOT NULL, '
            . OAuthClientsTable::OWNER_ID . ' ' . OAuthClientsTable::OWNER_ID_DATA_TYPE . ' NOT NULL, '
            . OAuthClientsTable::IS_FIRST_PARTY . ' ' . OAuthClientsTable::IS_FIRST_PARTY_DATA_TYPE . ' NOT NULL DEFAULT 0, '
            . OAuthClientsTable::NAME . ' ' . OAuthClientsTable::NAME_DATA_TYPE . ' NOT NULL, '
            . OAuthClientsTable::DESCRIPTION . ' ' . OAuthClientsTable::DESCRIPTION_DATA_TYPE . ' NULL, '
            . OAuthClientsTable::LOGO_FILE_PATH . ' ' . OAuthClientsTable::LOGO_FILE_PATH_DATA_TYPE . ' NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . OAuthClientsTable::ID . '), '
            . 'UNIQUE KEY (' . OAuthClientsTable::SECRET . '), '
            . 'UNIQUE KEY (' . OAuthClientsTable::NAME . '), '
            . 'FOREIGN KEY (' . OAuthClientsTable::CLIENT_TYPE_ID . ') REFERENCES ' . OAuthClientTypesTable::TABLE_NAME . ' ('
            . OAuthClientTypesTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ', '
            . 'FOREIGN KEY (' . OAuthClientsTable::OWNER_ID . ') REFERENCES ' . UsersTable::TABLE_NAME . '('
            . UsersTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ') '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getOAuthClientsTableDeletionQuery() {
        return 'DROP TABLE ' . OAuthClientsTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthClientGrantTypesTableCreationQuery() {
        return
            'CREATE TABLE ' . OAuthClientGrantTypesTable::TABLE_NAME . ' ('
            . OAuthClientGrantTypesTable::CLIENT_ID . ' ' . OAuthClientGrantTypesTable::CLIENT_ID_DATA_TYPE . ' NOT NULL, '
            . OAuthClientGrantTypesTable::GRANT_TYPE_ID . ' ' . OAuthClientGrantTypesTable::GRANT_TYPE_ID_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . OAuthClientGrantTypesTable::CLIENT_ID . ', ' . OAuthClientGrantTypesTable::GRANT_TYPE_ID . '), '
            . 'FOREIGN KEY (' . OAuthClientGrantTypesTable::CLIENT_ID . ') REFERENCES ' . OAuthClientsTable::TABLE_NAME . ' ('
            . OAuthClientsTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ', '
            . 'FOREIGN KEY (' . OAuthClientGrantTypesTable::GRANT_TYPE_ID . ') REFERENCES ' . OAuthGrantTypesTable::TABLE_NAME . ' ('
            . OAuthGrantTypesTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ') '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getOAuthClientGrantTypesTableDeletionQuery() {
        return 'DROP TABLE ' . OAuthClientGrantTypesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthClientScopesTableCreationQuery() {
        return
            'CREATE TABLE ' . OAuthClientScopesTable::TABLE_NAME . ' ('
            . OAuthClientScopesTable::CLIENT_ID . ' ' . OAuthClientScopesTable::CLIENT_ID_DATA_TYPE . ' NOT NULL, '
            . OAuthClientScopesTable::SCOPE_ID . ' ' . OAuthClientScopesTable::SCOPE_ID_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . OAuthClientScopesTable::CLIENT_ID . ', ' . OAuthClientScopesTable::SCOPE_ID . '), '
            . 'FOREIGN KEY (' . OAuthClientScopesTable::CLIENT_ID . ') REFERENCES ' . OAuthClientsTable::TABLE_NAME . ' ('
            . OAuthClientsTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ', '
            . 'FOREIGN KEY (' . OAuthClientScopesTable::SCOPE_ID . ') REFERENCES ' . OAuthScopesTable::TABLE_NAME . ' ('
            . OAuthScopesTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ') '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getOAuthClientScopesTableDeletionQuery() {
        return 'DROP TABLE ' . OAuthClientScopesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthClientEndpointsTableCreationQuery() {
        return
            'CREATE TABLE ' . OAuthClientEndpointsTable::TABLE_NAME . ' ('
            . OAuthClientEndpointsTable::ID . ' ' . OAuthClientEndpointsTable::ID_DATA_TYPE . ' NOT NULL AUTO_INCREMENT, '
            . OAuthClientEndpointsTable::CLIENT_ID . ' ' . OAuthClientEndpointsTable::CLIENT_ID_DATA_TYPE . ' NOT NULL, '
            . OAuthClientEndpointsTable::REDIRECT_URL . ' ' . OAuthClientEndpointsTable::REDIRECT_URL_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . OAuthClientEndpointsTable::ID . '), '
            . 'FOREIGN KEY (' . OAuthClientEndpointsTable::CLIENT_ID . ') REFERENCES ' . OAuthClientsTable::TABLE_NAME . ' ('
            . OAuthClientsTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ') '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getOAuthClientEndpointsTableDeletionQuery() {
        return 'DROP TABLE ' . OAuthClientEndpointsTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthAccessTokensTableCreationQuery() {
        return
            'CREATE TABLE ' . OAuthAccessTokensTable::TABLE_NAME . ' ('
            . OAuthAccessTokensTable::ID . ' ' . OAuthAccessTokensTable::ID_DATA_TYPE . ' NOT NULL, '
            . OAuthAccessTokensTable::CLIENT_ID . ' ' . OAuthAccessTokensTable::CLIENT_ID_DATA_TYPE . ' NOT NULL, '
            . OAuthAccessTokensTable::OWNER_TYPE_ID . ' ' . OAuthAccessTokensTable::OWNER_TYPE_ID_DATA_TYPE . ' NOT NULL, '
            . OAuthAccessTokensTable::OWNER_ID . ' ' . OAuthAccessTokensTable::OWNER_ID_DATA_TYPE . ' NOT NULL, '
            . OAuthAccessTokensTable::EXPIRE_TIME . ' ' . OAuthAccessTokensTable::EXPIRE_TIME_DATA_TYPE . ' NOT NULL, '
            . OAuthAccessTokensTable::IS_REVOKED . ' ' . OAuthAccessTokensTable::IS_REVOKED_DATA_TYPE . ' NOT NULL DEFAULT 0, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . OAuthAccessTokensTable::ID . '), '
            . 'FOREIGN KEY (' . OAuthAccessTokensTable::CLIENT_ID . ') REFERENCES ' . OAuthClientsTable::TABLE_NAME . ' ('
            . OAuthClientsTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ', '
            . 'FOREIGN KEY (' . OAuthAccessTokensTable::OWNER_TYPE_ID . ') REFERENCES ' . OAuthOwnerTypesTable::TABLE_NAME . ' ('
            . OAuthOwnerTypesTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ') '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getOAuthAccessTokensTableDeletionQuery() {
        return 'DROP TABLE ' . OAuthAccessTokensTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getOAuthRefreshTokensTableCreationQuery() {
        return
            'CREATE TABLE ' . OAuthRefreshTokensTable::TABLE_NAME . ' ('
            . OAuthRefreshTokensTable::ID . ' ' . OAuthRefreshTokensTable::ID_DATA_TYPE . ' NOT NULL, '
            . OAuthRefreshTokensTable::ACCESS_TOKEN_ID . ' ' . OAuthRefreshTokensTable::ACCESS_TOKEN_ID_DATA_TYPE . ' NOT NULL, '
            . OAuthRefreshTokensTable::EXPIRE_TIME . ' ' . OAuthRefreshTokensTable::EXPIRE_TIME_DATA_TYPE . ' NOT NULL, '
            . OAuthRefreshTokensTable::IS_REVOKED . ' ' . OAuthRefreshTokensTable::IS_REVOKED_DATA_TYPE . ' NOT NULL DEFAULT 0, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . OAuthRefreshTokensTable::ID . '), '
            . 'FOREIGN KEY (' . OAuthRefreshTokensTable::ACCESS_TOKEN_ID . ') REFERENCES ' . OAuthAccessTokensTable::TABLE_NAME . ' ('
            . OAuthAccessTokensTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ') '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getOAuthRefreshTokensTableDeletionQuery() {
        return 'DROP TABLE ' . OAuthRefreshTokensTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getDictionaryTableCreationQuery() {
        return
            'CREATE TABLE ' . DictionaryTable::TABLE_NAME . ' ('
            . DictionaryTable::ID . ' ' . DictionaryTable::ID_DATA_TYPE . ' NOT NULL AUTO_INCREMENT, '
            . DictionaryTable::WORD_ID . ' ' . DictionaryTable::WORD_ID_DATA_TYPE . ' NOT NULL, '
            . DictionaryTable::SYNONYM_SET_ID . ' ' . DictionaryTable::SYNONYM_SET_ID_DATA_TYPE . ' NOT NULL, '
            . DictionaryTable::CASED . ' ' . DictionaryTable::CASED_DATA_TYPE . ' NULL, '
            . DictionaryTable::EXAMPLES . ' ' . DictionaryTable::EXAMPlES_DATA_TYPE . ' NULL, '
            . DictionaryTable::SYNONYMS . ' ' . DictionaryTable::SYNONYMS_DATA_TYPE . ' NULL, '
            . DictionaryTable::ANTONYMS . ' ' . DictionaryTable::ANTONYMS_DATA_TYPE . ' NULL, '
            . DictionaryTable::DERIVATIONS . ' ' . DictionaryTable::DERIVATIONS_DATA_TYPE . ' NULL, '
            . DictionaryTable::LEARNER_COUNT . ' ' . DictionaryTable::LEARNER_COUNT_DATA_TYPE . ' NOT NULL DEFAULT 0, '
            . DictionaryTable::MASTER_COUNT . ' ' . DictionaryTable::MASTER_COUNT_DATA_TYPE . ' NOT NULL DEFAULT 0, '
            . DictionaryTable::LIKE_COUNT . ' ' . DictionaryTable::LIkE_COUNT_DATA_TYPE . ' NOT NULL DEFAULT 0, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . DictionaryTable::ID . '), '
            . 'FOREIGN KEY (' . DictionaryTable::WORD_ID . ') REFERENCES ' . WordsTable::TABLE_NAME . ' ('
            . WordsTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ', '
            . 'FOREIGN KEY (' . DictionaryTable::SYNONYM_SET_ID . ') REFERENCES ' . SynonymSetsTable::TABLE_NAME . ' ('
            . SynonymSetsTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ') '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getDictionaryTableTruncationQuery() {
        return 'TRUNCATE TABLE ' . DictionaryTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getDictionaryTableDeletionQuery() {
        return 'DROP TABLE ' . DictionaryTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getUserDictionaryEntriesTableCreationQuery() {
        return
            'CREATE TABLE ' . UserDictionaryEntriesTable::TABLE_NAME . ' ('
            . UserDictionaryEntriesTable::USER_ID . ' ' . UserDictionaryEntriesTable::USER_ID_DATA_TYPE . ' NOT NULL, '
            . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID . ' ' . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID_DATA_TYPE . ' NOT NULL, '
            . UserDictionaryEntriesTable::WORD_CATEGORY_ID . ' ' . UserDictionaryEntriesTable::WORD_CATEGORY_ID_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . UserDictionaryEntriesTable::USER_ID . ', ' . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '), '
            . 'FOREIGN KEY (' . UserDictionaryEntriesTable::USER_ID . ') REFERENCES ' . UsersTable::TABLE_NAME . ' ('
            . UsersTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ', '
            . 'FOREIGN KEY (' . UserDictionaryEntriesTable::DICTIONARY_ENTRY_ID . ') REFERENCES ' . DictionaryTable::TABLE_NAME . ' ('
            . DictionaryTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ', '
            . 'FOREIGN KEY (' . UserDictionaryEntriesTable::WORD_CATEGORY_ID . ') REFERENCES ' . WordCategoriesTable::TABLE_NAME . ' ('
            . WordCategoriesTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ') '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getUserDictionaryEntriesTableDeletionQuery() {
        return 'DROP TABLE ' . UserDictionaryEntriesTable::TABLE_NAME;
    }




    /**
     * @return string
     */
    public static function getUserLikedDictionaryEntriesTableCreationQuery() {
        return
            'CREATE TABLE ' . UserLikedDictionaryEntriesTable::TABLE_NAME . ' ('
            . UserLikedDictionaryEntriesTable::USER_ID . ' ' . UserLikedDictionaryEntriesTable::USER_ID_DATA_TYPE . ' NOT NULL, '
            . UserLikedDictionaryEntriesTable::DICTIONARY_ENTRY_ID . ' ' . UserLikedDictionaryEntriesTable::DICTIONARY_ENTRY_ID_DATA_TYPE . ' NOT NULL, '
            . QueryUtil::appendTableTimestampColumns() . ', '
            . 'PRIMARY KEY (' . UserLikedDictionaryEntriesTable::USER_ID . ', ' . UserLikedDictionaryEntriesTable::DICTIONARY_ENTRY_ID . '), '
            . 'FOREIGN KEY (' . UserLikedDictionaryEntriesTable::USER_ID . ') REFERENCES ' . UsersTable::TABLE_NAME . ' ('
            . UsersTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ', '
            . 'FOREIGN KEY (' . UserLikedDictionaryEntriesTable::DICTIONARY_ENTRY_ID . ') REFERENCES ' . DictionaryTable::TABLE_NAME . ' ('
            . DictionaryTable::ID . ') ' . QueryUtil::appendForeignKeyReferentialActions() . ') '
            . QueryUtil::appendTableMetaInfo()
        ;
    }




    /**
     * @return string
     */
    public static function getUserLikedDictionaryEntriesTableDeletionQuery() {
        return 'DROP TABLE ' . UserLikedDictionaryEntriesTable::TABLE_NAME;
    }
    
    
    
    
}