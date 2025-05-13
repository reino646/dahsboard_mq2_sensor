<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SignController;
use App\Http\Controllers\Dashboard2Controller;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\DataManageController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserHistoryController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserDataController;
use App\Http\Controllers\FirebaseUserController;
use App\Http\Controllers\UserManageController;

Route::get('/', function () {
    return view('login');
});
Route::get('/home', [HomeController::class, 'index1']);
Route::get('/dashboard2', [Dashboard2Controller::class, 'index2']);
Route::get('/signin/{displayName}', [SignController::class, 'signin']);
Route::get('/signout', [SignController::class, 'signout']);
Route::get('/users', [UsersController::class, 'index']);
Route::get('/dataManage', [DataManageController::class, 'index']);
Route::get('/data', [DataController::class, 'index']);
Route::get('/history', [HistoryController::class, 'index']);
Route::get('/userDashboard', [UserDashboardController::class, 'index2']);
Route::get('/userHistory', [UserHistoryController::class, 'index2']);
Route::get('/role', [RoleController::class, 'index']);
Route::post('/store-session', [SessionController::class, 'store']);
Route::get('/manage-users', [FirebaseUserController::class, 'index']);
Route::post('/update-role/{uid}', [FirebaseUserController::class, 'update']);
Route::get('/userData', [UserDataController::class, 'index']);
Route::get('/userManage', [UserManageController::class, 'index']);
Route::post('/delete-user/{uid}', [FirebaseUserController::class, 'delete']);