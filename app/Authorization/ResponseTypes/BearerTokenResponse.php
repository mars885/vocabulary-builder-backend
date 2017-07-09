<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/15/17
 * Time: 11:40 PM
 */

namespace App\Authorization\ResponseTypes;

use App\Model\Constants\StatusCodes;
use App\Model\OAuthAccessToken;
use App\Utils\ArrayUtils;
use App\Utils\StringUtils;
use App\Utils\TypeConverter;
use App\Utils\Utils;
use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Rsa\Sha256;
use Slim\Http\Response;

class BearerTokenResponse extends AbstractResponseType {




    /**
     * @param Response $response
     *
     * @return Response
     */
    public function generateHttpResponse($response) {
        // Fetching the timestamp of the expiration date of the access token
        $expireDateTime = $this->accessToken->getExpiryDateTime()->getTimestamp();

        // Fetching the scopes and converting them into the string
        $scopes = StringUtils::implode($this->scopeDelimiter, $this->accessToken->getScopes());

        // Converting the access token to the JWT format
        $jwtAccessToken = (new Builder())
            ->setAudience($this->accessToken->getClient()->getId())
            ->setId($this->accessToken->getId(), true)
            ->setIssuedAt(time())
            ->setNotBefore(time())
            ->setExpiration($expireDateTime)
            ->setSubject($this->accessToken->getOwnerId())
            ->set('scopes', $scopes)
            ->set('is_first_party', $this->accessToken->getClient()->isFirstParty())
            ->sign(new SHA256(), new Key($this->privateKey->getKeyPath()))
            ->getToken();

        // Combining the previously fetched data into an array
        $responseParams = [
            'token_type' => 'Bearer',
            'expires_in' => ($expireDateTime - (new \DateTime())->getTimestamp()),
            'scopes' => $scopes,
            'access_token' => TypeConverter::toString($jwtAccessToken),
        ];

        // Checking for refresh token presence
        if(Utils::isNotNull($this->refreshToken)) {
            // Creating the refresh token parameters
            $refreshTokenParams = [
                'client_id' => $this->accessToken->getClient()->getId(),
                'refresh_token_id' => $this->refreshToken->getId(),
                'access_token_id' => $this->accessToken->getId(),
                'scopes' => $scopes,
                'owner_id' => $this->accessToken->getOwnerId(),
                'expiry_time' => $this->refreshToken->getExpiryDateTime()->getTimestamp()
            ];

            // Encrypting the token with the server's encryption key
            // and adding it to the response parameters
            $responseParams['refresh_token'] = $this->encrypt(json_encode($refreshTokenParams));
        }

        // Merging the additional parameters
        $responseParams = ArrayUtils::merge($this->getExtraParams($this->accessToken), $responseParams);

        // Returning JSON response
        return $response
            ->withHeader('pragma', 'no-cache')
            ->withHeader('cache-control', 'no-store')
            ->withJson($responseParams, StatusCodes::OK);
    }




    /**
     * Add custom fields to your Bearer Token response here, then override
     * AuthorizationServer::getResponseType() to pull in your version of
     * this class rather than the default.
     *
     * @param OAuthAccessToken $accessToken
     *
     * @return array
     */
    protected function getExtraParams($accessToken) {
        return [];
    }




}