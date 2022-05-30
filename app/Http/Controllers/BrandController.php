<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BrandController extends Controller {
    public function brands(Request $request): JsonResponse {
        $keyword = $request->input('keyword');
        $brands  = Brand::where('brand_name', 'like', '%' . $keyword . '%')->get();
        
        $data = array();
        
        foreach ($brands as $brand) {
            $newBrand = [
                "Id"      => $brand->id,
                "Name"    => $brand->brand_name,
                "Picture" => $brand->picture,
            ];
            
            array_push($data, $newBrand);
        }
        
        return ApiController::api($data);
    }
}