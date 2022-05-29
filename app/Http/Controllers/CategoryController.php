<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller {
    public function productCategories(Request $request): JsonResponse {
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
            $newCat = [
                "CategoryId"   => $category->id,
                "CategoryName" => $category->category_name,
                "Picture"      => $category->picture,
                "ParentId"     => $category->parent_id
            ];
            
            array_push($data, $newCat);
        }
        
        return ApiController::api($data, null);
    }
    
    public function shopCategories(Request $request): JsonResponse {
        $shop = Auth::user()->shop->first();
        
        $categories = $shop->categories;
        
        $data = array();
        foreach ($categories as $category) {
            $newCat = [
                "CategoryId"   => $category->id,
                "CategoryName" => $category->category_name,
                "Picture"      => $category->picture,
                "ParentId"     => $category->parent_id
            ];
            
            array_push($data, $newCat);
        }
        
        return ApiController::api($data, null);
    }
    
    public function categorySpecs(Request $request) {
        $categoryId = $request->input('categoryId');
        
        $category = Category::find($categoryId);
        if (empty($category)) {
            return ApiController::api(null, "شناسه دسته بندی اشتباه است");
        }
        
        $specs = $category->specs;
        
        $specsData = array();
        foreach ($specs as $spec) {
            $specItems = $spec->specItems;
            
            $specItemsData = array();
            foreach ($specItems as $specItem) {
                $specValues = $specItem->specValues;
                $inputType  = $specItem->input;
                
                $specValuesData = array();
                foreach ($specValues as $specValue) {
                    $newSpecValue = [
                        "SpecValueId" => $specValue->id,
                        "Title"       => $specValue->title,
                    ];
                    
                    array_push($specValuesData, $newSpecValue);
                }
                
                $newSpecItem = [
                    "SpecItemId" => $specItem->id,
                    "IsRequired" => $specItem->is_required,
                    "InputID"    => $specItem->input_id,
                    "InputName"  => $inputType->name,
                    "InputTitle" => $inputType->title,
                    "Name"       => $specItem->name,
                    "Values"     => $specValuesData,
                ];
                
                array_push($specItemsData, $newSpecItem);
            }
            
            $newSpecData = [
                "SpecId" => $spec->id,
                "Name"   => $spec->spec_name,
                "Items"  => $specItemsData,
            ];
            
            array_push($specsData, $newSpecData);
        }
        
        return ApiController::api($specsData, null);
    }
}
