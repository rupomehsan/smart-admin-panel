<?php

use App\Http\Controllers\SmartFormValidation;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource("smart_validation", SmartFormValidation::class);
Route::post("file-upload", [SmartFormValidation::class, "fileUploader"]);
Route::post("manage_status_approval", [SmartFormValidation::class, "manageStatusApproval"]);
Route::post("get_date_wise_data", [SmartFormValidation::class, "getDateWiseSearchData"]);
Route::post("get_date_range_wise_data", [SmartFormValidation::class, "getDateRangeWiseSearchData"]);
Route::post("get_search_data", [SmartFormValidation::class, "getSearchData"]);
Route::post("manage_item_actions", [SmartFormValidation::class, "manageItemActions"]);
