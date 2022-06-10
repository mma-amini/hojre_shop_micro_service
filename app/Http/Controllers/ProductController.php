<?php

namespace App\Http\Controllers;

use App\Libraries\Helpers;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopProduct;
use Faker\Core\Uuid;
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
                "CategoryId"   => $category->id,
                "CategoryName" => $category->category_name,
                "Picture"      => $category->picture,
                "ParentId"     => $category->parent_id
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
                    "Picture" => $productImage->picture,
                    "IsMain"  => $productImage->is_main == 1,
                ];
                
                array_push($pictures, $picture);
            }
            
            $newPro = [
                "ProductId"                      => $product->id,
                "ProductName"                    => $product->product_name,
                "IsOriginal"                     => $product->is_original == 1,
                "Description"                    => $product->description,
                "PackingDimensions"              => $product->packaging_dimensions,
                "ProductDimensions"              => $product->product_dimensions,
                "PackingWeight"                  => $product->packing_weight,
                "ProductWeight"                  => $product->product_weight,
                'ApprovedProductDesignsCount'    => count($approvedDesigns),
                'NotApprovedProductDesignsCount' => count($notApprovedDesigns),
                "Brand"                          => $brand != null ?[
                    "Id"      => $brand->id,
                    "Name"    => $brand->brand_name,
                    "Picture" => $brand->picture,
                ] : null,
                "Pictures"                       => $pictures,
                "IsActive"                       => $product->is_active == 1,
            ];
            
            array_push($data, $newPro);
        }
        
        return ApiController::api($data, null);
    }
    
    public function insertProduct(Request $request): JsonResponse {
        $productName           = $request->input('ProductName');
        $productGroupID        = $request->input('ProductGroupID');
        $brandId               = $request->input('BrandId');
        $brandName             = $request->input('BrandName');
        $productPackWeight     = $request->input('ProductPackWeight');
        $productPackLength     = $request->input('ProductPackLength');
        $productPackWidth      = $request->input('ProductPackWidth');
        $productPackHeight     = $request->input('ProductPackHeight');
        $productPackWeightType = $request->input('ProductPackWeightType');
        $description           = $request->input('Description');
        $original              = $request->input('Original');
        $sections              = $request->input('Sections');
        
        return ApiController::api(Helpers::isNullOrEmptyString($brandId));
        
        if (Helpers::isNullOrEmptyString($brandId) && !(Helpers::isNullOrEmptyString($brandName))) {
            $brand             = new Brand();
//            $brand->id         = Str::uuid()->toString();
            $brand->brand_name = $brandName;
            $brand->is_active  = 1;
            
            $brand->save();
            $brandId = $brand->id;
        }
        
        $product = new Product();
        
//        $product->id                   = Str::uuid()->toString();
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
    
            return ApiController::api($productId);
        } else {
            return ApiController::api(null, "اشکال در روند برنامه", 410);
        }
    }
}
