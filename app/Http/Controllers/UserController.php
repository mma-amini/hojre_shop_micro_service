<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller {
    public function __construct() {
        //  $this->middleware('auth:api');
    }
    
    public function checkUser(Request $request): JsonResponse {
        $this->validate($request, [
            'phoneNumber' => 'required',
        ]);
        
        $username = $request->input('phoneNumber');
        
        $user = User::where('username', $username)->first();
        
        if (!empty($user)) {
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
                    return $this->sendCode($user);
                } else {
                    return ApiController::api(null, "فروشگاهی برای شما ثبت نشده است", 1, 410);
                }
            } else {
                return ApiController::api(null, "شما دسترسی لازم را ندارید", 1, 410);
            }
        } else {
            return ApiController::api(null, "کاربر یافت نشد", 1, 410);
        }
    }
    
    public function sendCode(User $user): JsonResponse {
        $code           = strval(rand(100000, 999999));
        $user->password = Hash::make($code);
        $user->save();
        
        $client        = DB::table('oauth_clients')->where('id', '2')->first();
        $client_secret = $client->secret;
        
        $data = [
            'Username'     => $user->username,
            'Minutes'      => 1,
            'Code'         => $code,
            'ClientSecret' => $client_secret,
        ];
        
        return ApiController::api($data);
    }
    
    public function insertUser($username): JsonResponse {
        $user           = new User();
        $user->username = $username;
        $user->save();
        
        return $this->sendCode($user);
    }
    
    public function profile(Request $request): JsonResponse {
        $user = $request->user();
        
        $data = [
            "UserId"    => $user->id,
            "FirstName" => $user->first_name,
            "LastName"  => $user->last_name,
            "Username"  => $user->username,
        ];
        
        return ApiController::api($data, null, 1, 200);
    }
    
    public function getUser() {
        $user = User::first();
        
        $data = $user->roles;

//        echo($data->shop_name);
        
        dd($data);
    }
}
