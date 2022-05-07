<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller {
    public function productDesignProducts(Request $request): JsonResponse {
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
    
    public function shopProducts(Request $request): JsonResponse {
        $shop       = Auth::user()->shop->first();
        $categoryId = $request->input('categoryId');
        
        $products = $shop->products;
        
        $data = array();
        foreach ($products as $product) {
            $brand         = $product->brand;
            $productImages = $product->productImages;
            
            $pictures = array();
            foreach ($productImages as $productImage) {
                $picture = [
                    "Picture" => $productImage->picture,
                    "IsMain"  => $productImage->is_main == 1,
                ];
                
                array_push($pictures, $picture);
            }
            
            $newPro = [
                "ProductId"         => $product->id,
                "ProductName"       => $product->product_name,
                "IsOriginal"        => $product->is_original == 1,
                "Description"       => $product->description,
                "PackingDimensions" => $product->packaging_dimensions,
                "ProductDimensions" => $product->product_dimensions,
                "PackingWeight"     => $product->packing_weight,
                "ProductWeight"     => $product->product_weight,
                "Brand"             => [
                    "Id"      => $brand->id,
                    "Name"    => $brand->brand_name,
                    "Picture" => $brand->picture,
                ],
                "Pictures"          => $pictures,
            ];
            
            array_push($data, $newPro);
        }
        
        return ApiController::api($data, null);
    }
}
