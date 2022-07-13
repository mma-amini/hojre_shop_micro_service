<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    public function shopProducts(Request $request): JsonResponse {
        $shop       = Auth::user()->shop->first();
        $categoryId = $request->input('categoryId');

        $products = $shop->products;

        $approvedProducts = array();

        if (!empty($categoryId)) {
            foreach ($products as $product) {
                $categories = $product->categories;
                foreach ($categories as $category) {
                    if (Str::contains($category->id, $categoryId)) {
                        $approvedProducts[] = $product;
                    }
                }
            }
        } else {
            $approvedProducts = $products;
        }

        $data = array();

        foreach ($approvedProducts as $product) {
            $brand              = $product->brand;
            $approvedDesigns    = $product->designs->where('is_active', 1);
            $notApprovedDesigns = $product->designs->where('is_active', 0);
            $productImages      = $product->productImages;

            $pictures = array();
            foreach ($productImages as $productImage) {
                $picture = [
                    "picture" => $productImage->picture,
                    "isMain"  => $productImage->is_main == 1,
                ];

                array_push($pictures, $picture);
            }

            $newPro = [
                "productId"                      => $product->id,
                "productName"                    => $product->product_name,
                "isOriginal"                     => $product->is_original == 1,
                "description"                    => $product->description,
                "packingDimensions"              => $product->packaging_dimensions,
                "productDimensions"              => $product->product_dimensions,
                "packingWeight"                  => $product->packing_weight,
                "productWeight"                  => $product->product_weight,
                'approvedProductDesignsCount'    => count($approvedDesigns),
                'notApprovedProductDesignsCount' => count($notApprovedDesigns),
                "brand"                          => $brand != null ? [
                    "id"      => $brand->id,
                    "name"    => $brand->brand_name,
                    "picture" => $brand->picture,
                ] : null,
                "pictures"                       => $pictures,
                "isActive"                       => $product->is_active == 1,
            ];

            array_push($data, $newPro);
        }

        return ApiController::api($data, null);
    }

    public function insertProduct(Request $request): JsonResponse {
        $productName           = $request->input('productName');
        $productGroupID        = $request->input('productGroupID');
        $brandId               = $request->input('brandId');
        $brandName             = $request->input('brandName');
        $productPackWeight     = $request->input('productPackWeight');
        $productPackLength     = $request->input('productPackLength');
        $productPackWidth      = $request->input('productPackWidth');
        $productPackHeight     = $request->input('productPackHeight');
        $productPackWeightType = $request->input('productPackWeightType');
        $description           = $request->input('description');
        $original              = $request->input('original');
        $sections              = $request->input('sections');

        if (Helpers::isNullOrEmptyString($brandId) && !(Helpers::isNullOrEmptyString($brandName))) {
            $brand             = new Brand();
            $brand->brand_name = $brandName;
            $brand->is_active  = 1;

            $brand->save();
            $brandId = $brand->id;
        }

        $product = new Product();

        $product->product_name         = $productName;
        $product->brand_id             = !(Helpers::isNullOrEmptyString($brandId)) ? $brandId : null;
        $product->is_original          = $original ? 1 : 0;
        $product->packaging_dimensions = $productPackWidth . "x" . $productPackHeight . "x" . $productPackLength;
        $product->packing_weight       = $productPackWeight . " " . $productPackWeightType;
        $product->product_dimensions   = $productPackWidth . "x" . $productPackHeight . "x" . $productPackLength;
        $product->product_weight       = $productPackWeight . " " . $productPackWeightType;
        $product->description          = $description;

        $isSaved = $product->save();

        if ($isSaved) {
            $productId = $product->id;

            $shop = Auth::user()->shop->first();

            $product->shops()->attach($shop->id);

            $data = ["productId" => $productId];
            return ApiController::api($data);
        } else {
            return ApiController::api(null, "اشکال در روند برنامه", 410);
        }
    }

    public function insertProductImage(Request $request): JsonResponse {
        $id        = $request->input('id');
        $productId = $request->input('productId');
        $isMain    = $request->input('isMain');
        $sort      = $request->input('sort');
        $image     = $request->file('image');

        $destination_path = './productImages';

        $imageData = $image->move($destination_path, $id . ".jpg");

        if ($imageData != null && $imageData->getFilename() != null) {

            $productImage             = new ProductImage();
            $productImage->id         = $id;
            $productImage->product_id = $productId;
            $productImage->picture    = "/productImages/" . $id . ".jpg";
            $productImage->is_main    = $isMain ? 1 : 0;

            $isSaved = $productImage->save();

            if ($isSaved) {
                return ApiController::api();
            } else {
                return ApiController::api(null, "اشکال در روند برنامه", 410);
            }
        } else {
            return ApiController::api(null, "اشکال در روند برنامه", 410);
        }
    }
}
