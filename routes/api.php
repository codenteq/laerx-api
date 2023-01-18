<?php

use App\Http\Controllers\API\Admin\CarType\CarTypeController;
use App\Http\Controllers\API\Admin\Company\CompanyController;
use App\Http\Controllers\API\Admin\Group\GroupController;
use App\Http\Controllers\API\Admin\Language\LanguageController;
use App\Http\Controllers\API\Admin\Payment\PaymentCouponController;
use App\Http\Controllers\API\Admin\Payment\PaymentPackageController;
use App\Http\Controllers\API\Admin\Payment\PaymentPlanController;
use App\Http\Controllers\API\Admin\Period\PeriodController;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', function () {
        return request()->user();
    });

    Route::prefix('admin')->group(function () {
        Route::apiResource('companies', CompanyController::class);
        Route::apiResource('languages', LanguageController::class);
        Route::apiResource('groups', GroupController::class);
        Route::apiResource('periods', PeriodController::class);
        Route::apiResource('car-types', CarTypeController::class);
        Route::prefix('payment')->group(function () {
            Route::apiResource('coupons', PaymentCouponController::class);
            Route::apiResource('plans', PaymentPlanController::class);
            Route::apiResource('packages', PaymentPackageController::class);
        });
    });
});
