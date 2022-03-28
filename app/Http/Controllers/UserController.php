<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UserController extends Controller {
    public function __construct() {
        //  $this->middleware('auth:api');
    }
    
    public function checkUser(Request $request): JsonResponse {
        $this->validate($request, [
            'Username' => 'required',
        ]);
        
        $username = $request->input('Username');
        
        $user = User::where('user_name', $username)->first();
        
        if (!empty($user)) {
            return $this->sendCode($user);
        } else {
            return $this->insertUser($username);
        }
    }
    
    public function sendCode(User $user): JsonResponse {
        $code           = "123456";
        $user->sms_code = $code;
        $user->save();
        
        $data = ['Username' => $user->user_name,
                 'Code'     => $code];
        
        return ApiController::api($data);
    }
    
    public function insertUser($username): JsonResponse {
        $user            = new User();
        $user->user_name = $username;
        $user->save();
        
        return $this->sendCode($user);
    }
    
    public function login(Request $request): JsonResponse {
        try {
            $this->validate($request, [
                'Username' => 'required',
                'Code'     => 'required'
            ]);
        } catch (ValidationException $e) {
        }
        
        $username = $request->input('Username');
        $code     = $request->input('Code');
        
        $user = User::where('user_name', $username)->where("sms_code", $code)->first();
        
        if (!empty($user)) {
            return $this->setToken($user);
        } else {
            return ApiController::api(null, "کاربر یافت نشد", 1, 410);
        }
    }
    
    public function refreshToken(Request $request): JsonResponse {
        $refreshToken = $request->headers->get('refreshToken');
        
        $user = User::where('remember_token', $refreshToken)->first();
        
        if (!empty($user)) {
            return $this->setToken($user);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    
    public function setToken(User $user): JsonResponse {
        $accessToken  = base64_encode(Str::random(40));
        $refreshToken = base64_encode(Str::random(40));
        $expireOn     = Carbon::now()->setTimezone("Asia/Tehran")->addMinutes(15);
        $expireIn     = $expireOn->timestamp - Carbon::now()->setTimezone("Asia/Tehran")->timestamp;
        
        $user->access_token   = $accessToken;
        $user->remember_token = $refreshToken;
        $user->expire_on      = $expireOn;
        $user->expire_in      = $expireIn;
        $user->save();
        
        $data = ["UserName"     => $user->user_name,
                 "FirstName"    => $user->first_name,
                 "LastName"     => $user->last_name,
                 "TokenType"    => "Bearer",
                 "AccessToken"  => $user->access_token,
                 "RefreshToken" => $user->remember_token,
                 "ExpireOn"     => $user->expire_on,
                 "ExpireIn"     => $user->expire_in];
        
        return ApiController::api($data);
    }
}
