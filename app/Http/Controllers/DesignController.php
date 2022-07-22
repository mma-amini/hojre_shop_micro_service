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
        $shop = Auth::user()->shop->first();
        $productId = $request->input('productId');

        $product = Product::find($productId);
        $designs = $product->designs->where('shop_id', $shop->id);

        $data = array();
        foreach ($designs as $design) {
            $warranty = $design->warranty;
            $warrantyData = null;
            if ($warranty != null) {
                $warrantyData = [
                    "id"                 => $warranty->id,
                    "warrantName"        => $warranty->warranty_name,
                    "warrantDescription" => $warranty->warranty_description,
                ];
            }

            $newDesign = [
                "id"         => $design->id,
                "shopId"     => $design->shop_id,
                "productId"  => $design->product_id,
                "warranty"   => $warrantyData,
                "designName" => $design->design_name,
                "barcode"    => $design->barcode,
                "price"      => $design->price,
                "offPrice"   => $design->off_price,
                "quantity"   => $design->quantity,
                "isReady"    => $design->is_ready == 1,
                "readyDay"   => $design->ready_day,
                "readyHour"  => $design->ready_hour,
            ];

            array_push($data, $newDesign);
        }

        return ApiController::api($data);
    }
}
