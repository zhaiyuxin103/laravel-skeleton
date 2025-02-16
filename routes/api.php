<?php

declare(strict_types=1);

use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationCodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// 登录相关接口
Route::middleware(['throttle:' . config('api.rate_limits.sign')])->group(function () {
    Route::apiResource('verification_codes', VerificationCodeController::class)->only(['store']);
    Route::post('users', [UserController::class, 'store'])->name('users.store');
    // 用户登录
    Route::post('authorizations', [AuthorizationController::class, 'store'])->name('authorizations.store');
    // 登录后可以访问的接口
    Route::middleware('auth:sanctum')->group(function () {
        // 删除 token
        Route::delete('authorizations/current', [AuthorizationController::class, 'destroy']);
    });
});

Route::middleware('throttle:' . config('api.rate_limits.access'))->group(function () {
    // 某个用户的详情
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show');
    // 登录后可以访问的接口
    Route::middleware('auth:sanctum')->group(function () {
        // 当前登录用户信息
        Route::get('user', [UserController::class, 'me'])->name('user.show');
        // 注销用户
        Route::delete('users/{user}', [UserController::class, 'destroy']);
        // 编辑当前用户信息
        Route::match(['patch', 'put'], 'user', [UserController::class, 'update']);
        // 修改密码
        Route::patch('/users/{user}/password', [UserController::class, 'updatePassword']);
        // 重置密码
        Route::patch('users/password/reset', [UserController::class, 'resetPassword']);
    });
});

Route::get('/', function () {
    return Response::success('Hello, Laravel Skeleton API!');
});
