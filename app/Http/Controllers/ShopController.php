<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller {
    public function shopInfo(): JsonResponse {
        $shop = Auth::user()->shop->first();

        $data = [
            "id" => $shop->id,
            "shopName" => $shop->shop_name,
        ];

        return ApiController::api($data);
    }
}
