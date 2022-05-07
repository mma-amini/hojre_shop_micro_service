<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller {
    public function productCategories(Request $request) {
        $shop = Auth::user()->shop->first();
        
        $categories = $shop->categories;
        $index      = 0;
        foreach ($categories as $category) {
            $products = $category->products;
            if (sizeof($products) == 0) {
                unset($categories[$index]);
                $index = $index + 1;
            }
        }
        $data = array();
        foreach ($categories as $category) {
            $newCat = ["CategoryId"   => $category->id,
                       "CategoryName" => $category->category_name,
                       "Picture"      => $category->picture,
                       "ParentId"     => $category->parent_id];
            
            array_push($data, $newCat);
        }
        
        return ApiController::api($data, null);
    }
    
    public function shopCategories(Request $request) {
        $shop = Auth::user()->shop->first();
        
        $categories = $shop->categories;
        
        $data = array();
        foreach ($categories as $category) {
            $newCat = ["CategoryId"   => $category->id,
                       "CategoryName" => $category->category_name,
                       "Picture"      => $category->picture,
                       "ParentId"     => $category->parent_id];
            
            array_push($data, $newCat);
        }
        
        return ApiController::api($data, null);
    }
}
