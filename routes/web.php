<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/getUser', 'UserController@getUser');

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->group(['prefix' => 'v1'], function () use ($router) {
//        $router->group(['prefix' => 'oauth'], function () use ($router) {
////            $router->post("/token", function () {
////                return ApiController::api(null, "امکان اجرای درخواست وجود ندارد", 1, 410, 410);
////            });
//        });

        $router->post('/auth/checkUser', [
            'uses' => 'UserController@checkUser',
            'as'   => 'checkUser',
        ]);

        $router->post('/auth/login', [
            'uses' => 'AuthController@login',
            'as'   => 'login',
            //            'middleware' => 'throttle',
        ]);

        $router->group(['middleware' => 'auth'], function () use ($router) {
            $router->get('/home', function () use ($router) {
                return $router->app->version();
            });

            $router->get('/user/profile', [
                'as'   => 'profile',
                'uses' => 'UserController@profile'
            ]);

            $router->get('/shop/shopInfo', [
                'as'   => 'shop.info',
                'uses' => 'ShopController@shopInfo'
            ]);

            $router->get('/shop/productGroups', [
                'as'   => 'category.product',
                'uses' => 'CategoryController@shopCategories'
            ]);

            $router->get('/shop/shopGroups', [
                'as'   => 'category.shop',
                'uses' => 'CategoryController@shopCategories'
            ]);

            $router->get('/shop/groupOptions', [
                'as'   => 'category.options',
                'uses' => 'CategoryController@categoryOptions'
            ]);

            $router->get('/shop/shopProducts', [
                'as'   => 'product.shop',
                'uses' => 'ProductController@shopProducts'
            ]);

            $router->get('/shop/getDesigns', [
                'as'   => 'design.all',
                'uses' => 'DesignController@getDesigns'
            ]);

            $router->get('/shop/brands', [
                'as'   => 'brand.all',
                'uses' => 'BrandController@brands'
            ]);

            $router->post('/shop/insertProduct', [
                'as'   => 'product.insert',
                'uses' => 'ProductController@insertProduct'
            ]);

            $router->post('/shop/insertProductImage', [
                'as'   => 'product.insert.image',
                'uses' => 'ProductController@insertProductImage'
            ]);
        });
    });
});
