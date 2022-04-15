<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;

class CategoryController extends Controller {
    public function categories(Request $request) {
        $this->validate($request, [
            'shopId' => 'required',
        ]);
        
        $shopID = $request->input('shopId');
        
        $shop = Shop::where('id', $shopID)->first();
        
        $categories = $shop->categories;
        $data       = array();
        foreach ($categories as $category) {
            $newCat = ["CategoryID"   => $category->id,
                       "CategoryName" => $category->category_name,
                       "Picture"      => $category->picture,
                       "ParentID"     => $category->parent_id];
            
            array_push($data, $newCat);
        }
        
        return ApiController::api($data, null);
    }
}