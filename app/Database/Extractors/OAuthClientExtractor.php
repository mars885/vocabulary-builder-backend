<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 12/30/17
 * Time: 5:27 PM
 */

namespace App\Database\Extractors;

use App\Database\Aliases\ColumnAliases;
use App\Database\Schemas\Tables\OAuthClientsTable;
use App\Database\Schemas\Tables\OAuthClientTypesTable;
use App\Database\Utils\CursorCommon;
use App\Model\Constants\Delimiters;
use App\Model\OAuthClient;
use App\Utils\ArrayUtils;
use App\Utils\Utils;

abstract class OAuthClientExtractor {




    /**
     * @param OAuthClient $client
     * @param array $cursor
     */
    public static function fillOutClient($client, $cursor) {
        if(Utils::isNull($client) || Utils::isInvalid($cursor)) {
            return;
        }

        // Filling out the object with cursor data
        $client->setId(CursorCommon::getString($cursor, OAuthClientsTable::ID));
        $client->setSecret(CursorCommon::getString($cursor, OAuthClientsTable::SECRET));
        $client->setType(CursorCommon::getString($cursor, OAuthClientTypesTable::TYPE));
        $client->setRedirectUrls(ArrayUtils::explode(
            Delimiters::DELIMITER_REDIRECT_URLS,
            CursorCommon::getString($cursor, ColumnAliases::REDIRECT_URLS)
        ));
        $client->setOwnerId(CursorCommon::getInt($cursor, OAuthClientsTable::OWNER_ID));
        $client->setFirstParty(CursorCommon::getBoolean($cursor, OAuthClientsTable::IS_FIRST_PARTY));
        $client->setName(CursorCommon::getString($cursor, OAuthClientsTable::NAME));
        $client->setDescription(CursorCommon::getString($cursor, OAuthClientsTable::DESCRIPTION));
        $client->setLogoFilePath(CursorCommon::getString($cursor, OAuthClientsTable::LOGO_FILE_PATH));
    }




    /**
     * @param array $cursor
     *
     * @return OAuthClient|null
     */
    public static function extractClient($cursor) {
        $clients = self::extractClients([$cursor]);
        return (Utils::isNotNull($clients) ? $clients[0] : null);
    }




    /**
     * @param array $cursors
     *
     * @return OAuthClient[]|null
     */
    public static function extractClients($cursors) {
        if(Utils::isInvalid($cursors)) {
            return null;
        }

        // Creating an array of OAuthClient objects
        $clients = array();

        foreach($cursors as $cursor) {
            $client = new OAuthClient();

            // Filling out the object with data
            self::fillOutClient($client, $cursor);

            // Adding the client to the array
            $clients[] = $client;
        }

        // Returning the array
        return $clients;
    }




}