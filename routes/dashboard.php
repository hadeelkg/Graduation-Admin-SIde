<?php

// use App\Http\Controllers\Dashboard\AboutUsController;
// use App\Http\Controllers\Dashboard\AuthController;
// use App\Http\Controllers\Dashboard\BlogController;
// use App\Http\Controllers\Dashboard\ClientController;
// use App\Http\Controllers\Dashboard\CommentApprovmentController;
// use App\Http\Controllers\Dashboard\CommentController;
// use App\Http\Controllers\Dashboard\PartnerController;
// use App\Http\Controllers\Dashboard\PermissionController;
// use App\Http\Controllers\Dashboard\PositionController;
// use App\Http\Controllers\Dashboard\ProfileController;
// use App\Http\Controllers\Dashboard\ProjectController;
// use App\Http\Controllers\Dashboard\ProjectLinkTypesController;
// use App\Http\Controllers\Dashboard\PublishBlogOnFacebook;
// use App\Http\Controllers\Dashboard\ServiceController;
// use App\Http\Controllers\Dashboard\Statistics\BlogController as StatisticsBlogController;
// use App\Http\Controllers\Dashboard\Statistics\GeneralStatisticController;
// use App\Http\Controllers\Dashboard\Statistics\PartnerController as StatisticsPartnerController;
// use App\Http\Controllers\Dashboard\Statistics\PositionMembersController;
// use App\Http\Controllers\Dashboard\Statistics\ProjectController as StatisticsProjectController;
// use App\Http\Controllers\Dashboard\Statistics\ServiceController as StatisticsServiceController;
// use App\Http\Controllers\Dashboard\TeamMemberController;
// use App\Http\Controllers\Dashboard\UserController;
// use App\Http\Controllers\Dashboard\UserpermissionController;
// use Illuminate\Support\Facades\Route;

// Route::post('login', [AuthController::class, 'login']);

// Route::group(['middleware' => ['auth:sanctum', 'localization']], function () {

//     Route::apiResource('users', UserController::class);
//     Route::apiResource('services', ServiceController::class);
//     Route::apiResource('clients', ClientController::class);
//     Route::apiResource('partners', PartnerController::class);
//     Route::apiResource('positions', PositionController::class);
//     Route::apiResource('members', TeamMemberController::class);
//     Route::apiResource('about-us', AboutUsController::class);
//     Route::apiResource('projects', ProjectController::class);
//     Route::apiResource('blogs', BlogController::class);
//     Route::apiResource('comments', CommentController::class);
//     Route::patch('comments/approve/{comment}', [CommentApprovmentController::class, 'update']);

//     Route::get('project-link-types', [ProjectLinkTypesController::class, 'index']);
//     Route::put('profile', [ProfileController::class, 'update']);

//     Route::get('permissions', PermissionController::class);
//     Route::get('user-permissions/{user}', UserpermissionController::class);

//     Route::prefix('/statistics')->group(function () {
//         Route::get('services-count', StatisticsServiceController::class);
//         Route::get('partners-count', StatisticsPartnerController::class);
//         Route::get('projects-count', StatisticsProjectController::class);
//         Route::get('blogs-count', StatisticsBlogController::class);

//         Route::get('position-members', PositionMembersController::class);

//         Route::get('general', GeneralStatisticController::class);
//     });


//     Route::post('logout', [AuthController::class, 'logout']);
// });

// Route::controller(PublishBlogOnFacebook::class)->group(function () {
//     Route::get('facebook/auth/redirect',  'redirect');
//     Route::get('facebook/auth/callback',  'callback');
// });
