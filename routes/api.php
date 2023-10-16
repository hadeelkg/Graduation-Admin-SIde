<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CityController;
use App\Http\Controllers\Api\V1\BrandController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\ClientController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\OrderProductController;
use App\Http\Controllers\Api\V1\PharmacistController;
use App\Http\Controllers\Api\V1\PrescriptionOrderController;
use App\Http\Controllers\Api\V1\ProductController;
use App\Http\Controllers\Api\V1\ProductImageController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\Api\V1\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoginClientController;
use App\Http\Controllers\ContactUsController;


Route::prefix('admin')->group(function () {
    Route::post('login',[LoginController::class, 'Login']);

    Route::group(['middleware' => ['auth:sanctum', 'localization']], function () {
        Route::prefix('v1')->group(function() {
            Route::apiResource('/cities', CityController::class);
        });

        Route::prefix('v1')->group(function() {
            Route::apiResource('/brands', BrandController::class);
        });

        Route::prefix('v1')->group(function() {
            Route::apiResource('/categories', CategoryController::class);
        });

        Route::prefix('v1')->group(function() {
            Route::apiResource('/clients', ClientController::class);
        });

        Route::prefix('v1')->group(function() {
            Route::apiResource('/comments', CommentController::class);
        });

        Route::prefix('v1')->group(function() {
            Route::apiResource('/orders', OrderController::class);
        });

        Route::prefix('v1')->group(function() {
            Route::apiResource('/order_products', OrderProductController::class);
        });
        Route::prefix('v1')->group(function() {
            Route::apiResource('/pharmacists', PharmacistController::class);
        });
        Route::prefix('v1')->group(function() {
            Route::apiResource('/prescription_order', PrescriptionOrderController::class);
        });
        Route::prefix('v1')->group(function() {
            Route::apiResource('/products', ProductController::class);
        });
        Route::prefix('v1')->group(function() {
            Route::apiResource('/product_image', ProductImageController::class);
        });
        Route::prefix('v1')->group(function() {
            Route::apiResource('/admins', AdminController::class);
        });

        Route::get('statistics',[StatisticsController::class, 'index']);
        Route::post('logout',[LoginController::class, 'Logout']);

    });
});


Route::prefix('client')->group(function () {
    Route::post('login-client',[LoginClientController::class, 'LoginClient']);

    Route::prefix('v1')->group(function() {
        Route::apiResource('/cities', CityController::class);
    });

    Route::prefix('v1')->group(function() {
        Route::apiResource('/brands', BrandController::class);
    });

    Route::prefix('v1')->group(function() {
        Route::apiResource('/categories', CategoryController::class);
    });

    Route::prefix('v1')->group(function() {
        Route::apiResource('/clients', ClientController::class);
    });

    Route::prefix('v1')->group(function() {
        Route::apiResource('/comments', CommentController::class);
    });

    Route::prefix('v1')->group(function() {
        Route::apiResource('/pharmacists', PharmacistController::class);
    });

    Route::prefix('v1')->group(function() {
        Route::apiResource('/products', ProductController::class);
    });
    // Route::prefix('v1')->group(function() {
    //     Route::apiResource('/product_image', ProductImageController::class);
    // });

    Route::group(['middleware' => ['auth:sanctum', 'localization']], function () {
               Route::prefix('v1')->group(function() {
            Route::apiResource('/orders', OrderController::class);
        });

        // Route::prefix('v1')->group(function() {
        //     Route::apiResource('/order_products', OrderProductController::class);
        // });

        Route::prefix('v1')->group(function() {
            Route::apiResource('/prescription_order', PrescriptionOrderController::class);
        });

        Route::post('/contact-us',[ContactUsController::class, 'submitForm']);
        Route::post('logout-client', [LoginClientController::class, 'LogoutClient']);
    });

});




// Route::group(['prefix'=>'admin','middleware' => ['auth:sanctum']], function(){

// });
