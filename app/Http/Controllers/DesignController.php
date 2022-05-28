<?php

namespace App\Http\Controllers;

use App\Models\Design;
use App\Models\Product;
use App\Models\Warranty;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;

class DesignController extends Controller {
    public function getDesigns(Request $request): JsonResponse {
        $shop      = Auth::user()->shop->first();
        $productId = $request->input('productId');
        
        $product = Product::find($productId);
        $designs = $product->designs->where('shop_id', $shop->id);
        
        $data = array();
        foreach ($designs as $design) {
            $warranty     = $design->warranty;
            $warrantyData = null;
            if ($warranty != null) {
                $warrantyData = [
                    "Id"                 => $warranty->id,
                    "WarrantName"        => $warranty->warranty_name,
                    "WarrantDescription" => $warranty->warranty_description,
                ];
            }
            
            $newDesign = [
                "Id"         => $design->id,
                "ShopId"     => $design->shop_id,
                "ProductId"  => $design->product_id,
                "Warranty"   => $warrantyData,
                "DesignName" => $design->design_name,
                "Barcode"    => $design->barcode,
                "Price"      => $design->price,
                "OffPrice"   => $design->off_price,
                "Quantity"   => $design->quantity,
                "IsReady"    => $design->is_ready == 1,
                "ReadyDay"   => $design->ready_day,
                "ReadyHour"  => $design->ready_hour,
            ];
            
            array_push($data, $newDesign);
        }
        
        return ApiController::api($data);
    }
}