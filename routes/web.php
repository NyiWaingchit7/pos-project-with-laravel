<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::middleware(['auth_admin'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});


Route::middleware(['auth'])->group(function () {
    //dashboard

    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    //admin
    Route::prefix('account')->group(function () {

    Route::get('passChange',[AuthController::class,'passChange'])->name('passChange');
    Route::post('changePass',[AuthController::class,'changePass'])->name('pass#Change');
    Route::get('detail',[AuthController::class,'detailPage'])->name('deatilPage');
    Route::get('edit',[AuthController::class,'accountEdit'])->name('account#editPage');
    Route::post('update/{id}',[AuthController::class,'accountUpdate'])->name('account#update');
    Route::get('list',[AuthController::class,'list'])->name('admin#list');
    Route::get('delete/{id}',[AuthController::class,'delete'])->name('admin#delete');
    Route::get('change/{id}',[AuthController::class,'changePage'])->name('admin#roleChangePage');
    Route::post('change/{id}',[AuthController::class,'changeRole'])->name('admin#roleChange');
    Route::get('message/delete/{id}',[AuthController::class,'messageDelete'])->name('message#delete');



    });
    //category
    Route::group(['prefix'=>'category','middleware'=>'auth_admin'],function(){
        Route::get('list',[CategoryController::class,'list'])->name('listPage');
        Route::get('createPage',[CategoryController::class,'createPage'])->name('category#createPage');
        Route::post('create',[CategoryController::class,'categoryCreate'])->name('category#create');
        Route::get('delete/{id}',[CategoryController::class,'categoryDelete'])->name('category#delete');
       Route::get('viewPage/{id}',[CategoryController::class,'editPage'])->name('editPage');
       Route::post('edit/{id}',[CategoryController::class,'categoryEdit'])->name('category#edit');
        });

        //product
        Route::prefix('product')->group(function () {
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            Route::get('addList',[ProductController::class,'addList'])->name('product#add');
            Route::post('addList',[ProductController::class,'createList'])->name('product#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            Route::get('view/{id}',[ProductController::class,'view'])->name('product#view');
            Route::get('editPage/{id}',[ProductController::class,'editPage'])->name('product#edit');
            Route::post('edit',[ProductController::class,'update'])->name('product#update');
            Route::get('viewcount',[ProductController::class,'viewCount'])->name('viewCount');

        });
        //order
        Route::prefix('order')->group(function () {
            Route::get('list',[OrderController::class,'list'])->name('order#list');
            Route::post('status',[OrderController::class,'status'])->name('order#status');
            Route::get('change/status',[OrderController::class,'changeStatus'])->name('order#changeStatus');
            Route::get('userList',[OrderController::class,'userList'])->name('userList');
            Route::get('user/delete',[OrderController::class,'userDelete'])->name('userDelete');
            Route::get('change/role',[OrderController::class,'changeRole'])->name('changeRole');
            Route::get('orderList/{code}',[OrderController::class,'codeList'])->name('orderCodeList');
        });


    //user
    //account\
    Route::prefix('account')->group(function () {
        Route::get('passwordChange',[UserController::class,'passwordPage'])->name('accoun#passwordPage');
        Route::post('passchange',[UserController::class,'passChange'])->name('account#passChange');

    });
    //home
    Route::group(['prefix'=>'user','middleware'=>'auth_user'],function(){
        Route::get('home',[UserController::class,'home'])->name('user#home');
        Route::get('category/{id}',[UserController::class,'category'])->name('user#cate');
        Route::get('product/detail/{id}',[UserController::class,'detail'])->name('product#detail');
        Route::get('history',[UserController::class,'history'])->name('user#history');
    });
    //cart
    Route::prefix('cart')->group(function () {

        Route::get('create',[CartController::class,'cartCreate'])->name('cart#create');
        Route::get('edit',[CartController::class,'edit'])->name('cart#edit');

    });
    //contact
    Route::prefix('contact')->group(function () {
        Route::get('contact',[ContactController::class,'contact'])->name('contact');
        Route::post('message',[ContactController::class,'message'])->name('contact#message');
        Route::get('show',[ContactController::class,'show'])->name('contact#show');

    });

    // ajax
    Route::prefix('ajax')->group(function () {
        Route::get('pizzalist',[AjaxController::class,'sorting'])->name('Ajax#sorting');
        Route::get('order',[AjaxController::class,'order'])->name('Ajax#order');
        Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('clear#cart');
        Route::get('clear',[AjaxController::class,'clear'])->name('clear');


    });

});

