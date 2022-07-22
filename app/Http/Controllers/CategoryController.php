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
        $index = 0;
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
                "id"           => $category->id,
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
                "id"           => $category->id,
                "categoryName" => $category->category_name,
                "picture"      => $category->picture,
                "parentId"     => $category->parent_id
            ];

            array_push($data, $newCat);
        }

        return ApiController::api($data, null);
    }

    public function categoryOptions(Request $request): JsonResponse {
        $categoryId = $request->input('categoryId');

        $category = Category::find($categoryId);
        if (empty($category)) {
            return ApiController::api(null, "شناسه دسته بندی اشتباه است");
        }

        $options = $category->options;

        $optionsData = array();
        foreach ($options as $option) {
            $optionItems = $option->optionItems;

            $optionItemsData = array();
            foreach ($optionItems as $optionItem) {
                $optionValues = $optionItem->optionValues;
                $inputType = $optionItem->input;

                $optionValuesData = array();
                foreach ($optionValues as $optionValue) {
                    $newOptionValue = [
                        "id"    => $optionValue->id,
                        "title" => $optionValue->title,
                        "value" => $optionValue->title,
                    ];

                    array_push($optionValuesData, $newOptionValue);
                }

                $newOptionItem = [
                    "id"         => $optionItem->id,
                    "isRequired" => $optionItem->is_required,
                    "inputName"  => $inputType->name,
                    "inputTitle" => $inputType->title,
                    "name"       => $optionItem->name,
                    "values"     => $optionValuesData,
                ];

                array_push($optionItemsData, $newOptionItem);
            }

            $newOptionData = [
                "id"    => $option->id,
                "name"  => $option->option_name,
                "items" => $optionItemsData,
            ];

            array_push($optionsData, $newOptionData);
        }

        return ApiController::api($optionsData, null);
    }
}
