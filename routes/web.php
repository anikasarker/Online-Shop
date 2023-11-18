<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;




Route::controller(HomeController::class)->group(function( ){

    Route::get('/', 'index')->name('home');

});

Route::controller(ClientController::class)->group(function( ){
    Route::get('/category/{id}/{slug}', 'CategoryPage')->name('category');
    Route::get('/singleproduct/{id}/{slug}', 'SingleProduct')->name('singleproduct');
    Route::get('/newrelease', 'NewRelease')->name('newrelease');
});

Route::middleware(['auth' , 'role:user'])->group(function(){
    Route::controller(ClientController::class)->group(function( ){
        Route::get('/addtocart', 'AddToCart')->name('addtocart');  
        Route::post('/addproducttocart', 'AddProductToCart')->name('addproducttocart');
        Route::get('/checkout', 'Checkout')->name('checkout');
        Route::get('/userprofile', 'UserProfile')->name('userprofile');
        Route::get('/userprofile/pendingorder', 'PendingOrder')->name('pendingorders');
        Route::get('/userprofile/history', 'History')->name('history');
        Route::get('/todaysdeal', 'TodaysDeal')->name('todaysdeal');
        Route::get('/customservice', 'CustomerService')->name('customerservice');
    });
});

Route::get('/ddashboard', function () {
    return view('ddashboard');
})->middleware(['auth', 'verified','role:user'])->name('ddashboard');

Route::middleware('auth','role:user')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth','role:admin')->group(function () {
    Route::controller(DashboardController::class)->group(function( ){
            Route::get('/admin/dashboard', 'index')->name('admindashboard');
    });
     
 });
 Route::controller(CategoryController::class)->group(function( ){
    Route::get('/admin/AllCategory', 'index')->name('allcategory');
    Route::get('/admin/AddSategory', 'AddCategory')->name('addcategory');
    Route::post('/admin/storecategory', 'StoreCategory')->name('storecategory');
    Route::get('/admin/editcategory/{id}', 'EditCategory')->name('editcategory');
    Route::post('/admin/updatecategory', 'UpdateCategory')->name('updatecategory'); 
    Route::get('/admin/deletecategory/{id}', 'DeleteCategory')->name('deletecategory');


});
Route::controller(SubCategoryController::class)->group(function( ){
    Route::get('/admin/AllSubCategory', 'index')->name('allsubcategory');
    Route::get('/admin/AddSubCategory', 'AddSubCategory')->name('addsubcategory');
    Route::post('/admin/storesubcategory', 'StoreSubCategory')->name('storesubcategory');
    Route::get('/admin/editsubcategory/{id}', 'EditSubCategory')->name('editsubcategory');
    Route::post('/admin/updatesubcategory', 'UpdateSubCategory')->name('updatesubcategory'); 
    Route::get('/admin/deletesubcategory/{id}', 'DeleteSubCategory')->name('deletesubcategory');
});
Route::controller(ProductController::class)->group(function( ){
    Route::get('/admin/AllProduct', 'index')->name('allproduct');
    Route::get('/admin/AddProduct', 'AddProduct')->name('addproduct');
    Route::post('/admin/StoreProduct', 'StoreProduct')->name('storeproduct');
    Route::get('/admin/editproductimg/{id} ', 'EditProductImg')->name('editproductimg');
    Route::post('/admin/updateproductimg', 'UpdateProductImg')->name('updateproductimg');
    Route::get('/admin/editproduct/{id}', 'EditProduct')->name('editproduct');
    Route::post('/admin/updateproduct' , 'updateProduct')->name('updateproduct');
    Route::get('/admin/deleteproduct/{id}', 'DeleteProduct')->name('deleteproduct');
});
Route::controller(OrderController::class)->group(function( ){
    Route::get('/admin/PendingOrder', 'index')->name('pendingorder');
   


});



require __DIR__.'/auth.php';
