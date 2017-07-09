<?php
/**
 * Created by PhpStorm.
 * User: Paul Rybitskyi
 * Date: 10/19/17
 * Time: 12:37 AM
 */

namespace App\Authorization\Grants;

use App\Exceptions\BadRequestException;
use App\Exceptions\OAuth2Exception;
use App\Model\Constants\OAuthGrantTypes;
use App\Repositories\Interfaces\OAuthRefreshTokenRepositoryInterface;
use App\Utils\StringUtils;
use App\Utils\Utils;
use Slim\Http\Request;

class RefreshTokenGrant extends BaseGrant {




    /**
     * @param OAuthRefreshTokenRepositoryInterface $refreshTokenRepository
     * @param \DateInterval $refreshTokenTTL
     */
    public function __construct($refreshTokenRepository, $refreshTokenTTL) {
        $this->setRefreshTokenRepository($refreshTokenRepository);
        $this->setRefreshTokenTTL($refreshTokenTTL);
    }




    /**
     * {@inheritdoc}
     */
    public function respondToTokenRequest($request, $response, $accessTokenTTL) {
        // Validating the request
        $client = $this->validateClient($request);
        $oldRefreshTokenData = $this->validateOldRefreshToken($request, $client->getId());
        $scopes = $this->validateScopes($request, $client);

        // According to spec, a refresh token can have the original scopes or fewer, so
        // checking whether the request does not include new scopes
        foreach($scopes as $scope) {
            if(!StringUtils::contains($oldRefreshTokenData['scopes'], $scope->__toString())) {
                throw OAuth2Exception::invalidScope($scope->__toString());
            }
        }

        // Expire old tokens
        $this->accessTokenRepository->revokeAccessToken($oldRefreshTokenData['access_token_id']);
        $this->refreshTokenRepository->revokeRefreshToken($oldRefreshTokenData['refresh_token_id']);

        // Issue and persist new tokens
        $accessToken = $this->issueAccessToken($accessTokenTTL, $client, $oldRefreshTokenData['owner_id'], $scopes);
        $refreshToken = $this->issueRefreshToken($accessToken);

        // Inject tokens into response
        $response->setAccessToken($accessToken);
        $response->setRefreshToken($refreshToken);

        return $response;
    }




    /**
     * @param Request   $request
     * @param string    $clientId
     * @throws BadRequestException
     * @return array
     */
    protected function validateOldRefreshToken($request, $clientId) {
        // Fetching the refresh token from the request
        $encryptedRefreshToken = $request->getParsedBodyParam('refresh_token');

        // Checking whether the refresh token has been successfully fetched
        if(Utils::isNull($encryptedRefreshToken)) {
            throw BadRequestException::invalidParameter('refresh_token');
        }

        // Validating the refresh token
        try {
             $refreshToken = $this->decrypt($encryptedRefreshToken);
        } catch (\Exception $e) {
            throw BadRequestException::invalidParameter('refresh_token', 'Cannot decrypt the refresh token.');
        }

        // Converting the JSON string into the associative array
        $refreshTokenData = json_decode($refreshToken, true);

        // Checking whether the client matches with the provided one
        if($refreshTokenData['client_id'] !== $clientId) {
            throw BadRequestException::invalidParameter('refresh_token', 'The refresh token is not linked to the specified client.');
        }

        // Checking whether the refresh token is expired
        if($refreshTokenData['expiry_time'] < time()) {
            throw BadRequestException::invalidParameter('refresh_token', 'The refresh token has expired.');
        }

        // Checking whether the refresh token is revoked
        if($this->refreshTokenRepository->isRefreshTokenRevoked($refreshTokenData['refresh_token_id']) === true) {
            throw BadRequestException::invalidParameter('refresh_token', 'The refresh token has been revoked.');
        }

        return $refreshTokenData;
    }




    /**
     * {@inheritdoc}
     */
    public function getId() {
        return OAuthGrantTypes::REFRESH_TOKEN;
    }




}