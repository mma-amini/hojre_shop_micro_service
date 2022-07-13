<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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
            $user          = User::where('username', $username)->first();
            $client        = DB::table('oauth_clients')->where('id', '2')->first();
            $client_secret = $client->secret;

            // Check roles
            $roles  = $user->roles;
            $isShop = false;
            foreach ($roles as $role) {
                if (Str::contains($role->id, "b6b7a78d-70f3-467a-afb8-18c0661cb0c9")) {
                    $isShop = true;
                }
            }

            if ($isShop) {
                // Check Shop
                $shop = $user->shop;
                if (!empty($shop)) {
                    // Genereting token
                    $tokenResponse = parent::issueToken($request);

                    //convert token response to json string
                    $token = json_decode($tokenResponse->content());

                    $data = [
                        "userId"       => $user->id,
                        "username"     => $user->username,
                        "firstName"    => $user->first_name,
                        "lastName"     => $user->last_name,
                        "shopId"       => $shop->id,
                        "shopName"     => $shop->shop_name,
                        "tokenType"    => $token->token_type,
                        "accessToken"  => $token->access_token,
                        "refreshToken" => $token->refresh_token,
                        "expiresIn"    => $token->expires_in,
                        'clientSecret' => $client_secret,
                    ];

                    return ApiController::api($data, null);
                } else {
                    return ApiController::api(null, "فروشگاهی برای شما ثبت نشده است", 1, 410);
                }
            } else {
                return ApiController::api(null, "شما دسترسی لازم را ندارید", 1, 410);
            }
        } catch (OAuthServerException $e) {
            return ['message' => 'The suer credentials were incorrect!'];
        } catch (\Exception $e) {
            return ['message' => 'Exception: ' . $e];
        }
    }
}
