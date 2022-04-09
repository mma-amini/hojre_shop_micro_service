<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\OAuth2\Server\Exception\OAuthServerException;
use Psr\Http\Message\ServerRequestInterface;
use \Laravel\Passport\Http\Controllers\AccessTokenController as ATC;

class AuthController extends ATC {
    public function login(ServerRequestInterface $request) {
        try {
            $body = $request->getParsedBody();
            
            // Fetching username from request
            $username = $body["username"];
            
            // Fetching the User
            $user     = User::where('username', $username)->first();
            
            // Genereting token
            $tokenResponse = parent::issueToken($request);
            
            //convert token response to json string
            $token = json_decode($tokenResponse->content());
            
            $data = ["UserID"       => $user->id,
                     "Username"     => $user->username,
                     "FirstName"    => $user->first_name,
                     "LastName"     => $user->last_name,
                     "TokenType"    => $token->token_type,
                     "AccessToken"  => $token->access_token,
                     "RefreshToken" => $token->refresh_token,
                     "ExpiresIn"    => $token->expires_in,];
            
            return ApiController::api($data, null);
        } catch (OAuthServerException $e) {
            return ['Message' => 'The suer credentials were incorrect!'];
        } catch (\Exception $e) {
            return ['Message' => 'Exception: ' . $e];
        }
    }
}