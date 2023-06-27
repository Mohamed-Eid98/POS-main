<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;

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

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'root'])->name('root');

// //Update User Details
// Route::post('/update-profile/{id}', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('updateProfile');
// Route::post('/update-password/{id}', [App\Http\Controllers\HomeController::class, 'updatePassword'])->name('updatePassword');

// Route::get('{any}', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

// //Language Translation
// Route::get('index/{locale}', [App\Http\Controllers\HomeController::class, 'lang']);
Route::get('/about', function () {
    return view('form-uploads');
});
// Route::get('category/add',  [CategoryController::class, 'Add'])->name('category.add');;


//////////// Start Category All Routes //////////

Route::get('/addCategory', [CategoryController::class, 'Add'])->name('category.add');
Route::post('/add', [CategoryController::class, 'Store'])->name('category.store');
Route::get('/show', [CategoryController::class, 'Show'])->name('category.show');
Route::get('/edit-{id}', [CategoryController::class, 'Edit'])->name('category.edit');
Route::post('/update', [CategoryController::class, 'Update'])->name('category.update');
Route::get('/delete-{id}', [CategoryController::class, 'Delete'])->name('category.delete');
Route::get('/category-page-{id}', [CategoryController::class, 'showPage'])->name('category.page');


//////////// End Category All Routes //////////

//////////// Start subCategory All Routes /////////

Route::get('/subcategory-add', [SubCategoryController::class, 'Add'])->name('subcategory.add');
Route::post('/subcategory/add', [SubCategoryController::class, 'Store'])->name('subcategory.store');
Route::get('/subcategory-show', [SubCategoryController::class, 'Show'])->name('subcategory.show');
Route::get('/subcategory-edit-{id}', [SubCategoryController::class, 'Edit'])->name('subcategory.edit');
Route::post('/subcategory-update', [SubCategoryController::class, 'Update'])->name('subcategory.update');
Route::get('/subcategory/delete/{id}', [SubCategoryController::class, 'Delete'])->name('subcategory.delete');

//////////// End Category All Routes //////////

//////////// Start Product All Routes //////////

Route::get('/add2', [ProductController::class, 'Add'])->name('product.add');
Route::post('/product/add', [ProductController::class, 'Store'])->name('product.store');
Route::get('/subcategory/ajax/{id}', [ProductController::class, 'AjaxShow']);
Route::get('/showp', [ProductController::class, 'Show'])->name('product.show');
Route::get('/product-edit-{id}', [ProductController::class, 'Edit'])->name('product.edit');
Route::post('/product/update', [ProductController::class, 'Update'])->name('product.update');
Route::get('/product/delete/{id}', [ProductController::class, 'Delete'])->name('product.delete');
Route::get('/product-subcategory-{id}', [ProductController::class, 'showSub'])->name('product.show.subcategory');

//////////// End Product All Routes //////////

Route::get('/order', [OrdersController::class, 'index'])->name('orders.show');
Route::get('/active/{id}', [OrdersController::class, 'Paid'])->name('orders.paid');
Route::get('/inactive/{id}', [OrdersController::class, 'UnPaid'])->name('orders.unpaid');
