<?php

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::view("dashboard", "admin.dashboard.index");
    Route::view("smart-validation", "admin.smart_validation.index");
    Route::view("smart-validation-create", "admin.smart_validation.create");
    Route::view("smart-validation-edit/{id}", "admin.smart_validation.edit");
});

Route::redirect("/", "admin/dashboard");