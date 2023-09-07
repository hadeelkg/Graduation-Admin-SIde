<?php

// use App\Http\Controllers\Website\AboutUsController;
// use App\Http\Controllers\Website\BlogController;
// use App\Http\Controllers\Website\ClientController;
// use App\Http\Controllers\Website\CommentController;
// use App\Http\Controllers\Website\ContactUsController;
// use App\Http\Controllers\Website\PartnerController;
// use App\Http\Controllers\Website\ProjectController;
// use App\Http\Controllers\Website\ServiceController;
// use App\Http\Controllers\Website\TeamMemberController;
// use Illuminate\Support\Facades\Route;

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

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware("localization")->group(function () {
//     Route::get('services', [ServiceController::class, 'index']);
//     Route::get('clients', [ClientController::class, 'index']);
//     Route::get('partners', [PartnerController::class, 'index']);
//     Route::get('members', [TeamMemberController::class, 'index']);
//     Route::get('about-us', [AboutUsController::class, 'index']);
//     Route::get('projects', [ProjectController::class, 'index']);
//     Route::get('blogs', [BlogController::class, 'index']);
//     Route::apiResource('comments', CommentController::class)->only(['index', 'store']);
//     Route::post('contact-us', [ContactUsController::class, 'store']);
// });

// Route::get('test', function () {
//     dd(app());
// });

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
