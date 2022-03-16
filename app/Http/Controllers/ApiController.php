<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;

class ApiController extends Controller {
    public static function api($data = null, $message = "", $messageType = 1, $statusCode = 200) {
        return response()->json(["StatusCode" => $statusCode, "Message" => ["Message" => $message, "Type" => $messageType], "Data" => $data], 200);
    }
}