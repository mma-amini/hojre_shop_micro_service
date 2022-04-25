<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function productDesignProducts(Request $request) {
        $this->validate($request, [
            'shopId' => 'required',
        ]);
        
        $shopID = $request->input('shopId');
        
        $shop = Shop::where('id', $shopID)->first();
        
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
    
    public function shopProducts(Request $request) {
        $this->validate($request, [
            'shopId' => 'required',
        ]);
        
        $shopId     = $request->input('shopId');
        $categoryId = $request->input('categoryId');
        
        $shop = Shop::where('id', $shopId)->first();
        
        $products = $shop->products;
        
        $data = array();
        foreach ($products as $product) {
            $newPro = ["ProductId"   => $product->id,
                       "ProductName" => $product->Product_name];
            
            array_push($data, $newPro);
        }
        
        return ApiController::api($data, null);
    }
}
