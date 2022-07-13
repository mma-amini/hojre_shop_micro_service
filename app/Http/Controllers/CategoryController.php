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
                "categoryId"   => $category->id,
                "categoryName" => $category->category_name,
                "picture"      => $category->picture,
                "parentId"     => $category->parent_id
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
                "categoryId"   => $category->id,
                "categoryName" => $category->category_name,
                "picture"      => $category->picture,
                "parentId"     => $category->parent_id
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
                        "specValueId" => $specValue->id,
                        "title"       => $specValue->title,
                    ];

                    array_push($specValuesData, $newSpecValue);
                }

                $newSpecItem = [
                    "specItemId" => $specItem->id,
                    "isRequired" => $specItem->is_required,
                    "inputID"    => $specItem->input_id,
                    "inputName"  => $inputType->name,
                    "inputTitle" => $inputType->title,
                    "name"       => $specItem->name,
                    "values"     => $specValuesData,
                ];

                array_push($specItemsData, $newSpecItem);
            }

            $newSpecData = [
                "specId" => $spec->id,
                "name"   => $spec->spec_name,
                "items"  => $specItemsData,
            ];

            array_push($specsData, $newSpecData);
        }

        return ApiController::api($specsData, null);
    }
}
