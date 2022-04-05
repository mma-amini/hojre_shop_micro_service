<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            return $this->sendCode($user);
        } else {
            return ApiController::api(null, "کاربر یافت نشد", 1, 410);
//            return $this->insertUser($username);
        }
    }
    
    public function sendCode(User $user): JsonResponse {
        $code           = strval(rand(100000, 999999));
        $user->password = Hash::make($code);
        $user->save();
        
        $data = ['Username' => $user->username,
                 'Minutes'  => 1,
                 'Code'     => $code];
        
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
        
        $data = ["UserID"    => $user->id,
                 "FirstName" => $user->first_name,
                 "LastName"  => $user->last_name,
                 "Username"  => $user->username,];
        
        return ApiController::api($data, null, 1, 200);
    }
    
    public function getUser() {
        $user = User::first();
        
        $data = $user->roles;

//        echo($data->shop_name);
        
        dd($data);
    }
}
