<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
            $user = User::where('username', $username)->first();
            
            // Check roles
            $roles = $user->roles;
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
        
                    $data = ["UserID"       => $user->id,
                             "Username"     => $user->username,
                             "FirstName"    => $user->first_name,
                             "LastName"     => $user->last_name,
                             "ShopID"       => $shop->id,
                             "ShopName"     => $shop->shop_name,
                             "TokenType"    => $token->token_type,
                             "AccessToken"  => $token->access_token,
                             "RefreshToken" => $token->refresh_token,
                             "ExpiresIn"    => $token->expires_in,];
        
                    return ApiController::api($data, null);
                } else {
                    return ApiController::api(null, "فروشگاهی برای شما ثبت نشده است", 1, 410);
                }
            } else {
                return ApiController::api(null, "شما دسترسی لازم را ندارید", 1, 410);
            }
        } catch (OAuthServerException $e) {
            return ['Message' => 'The suer credentials were incorrect!'];
        } catch (\Exception $e) {
            return ['Message' => 'Exception: ' . $e];
        }
    }
}