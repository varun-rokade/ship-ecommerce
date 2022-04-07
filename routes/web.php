<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ShippingAreaController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\User\CheckOutController;
use App\Http\Controllers\User\MyCartController;
use App\Http\Controllers\User\StripeController;
use App\Http\Controllers\User\WishListController;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\User;
// use Auth;


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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=> 'admin', 'middleware'=>['admin:admin']], function(){
	Route::get('/login', [AdminController::class, 'loginForm']);
	Route::post('/login',[AdminController::class, 'store'])->name('admin.login');
});




Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

//Admin Routes Start

    Route::get('/logout',[AdminController::class,'destroy'])->name('admin.logout');
    Route::get('/admin/profile',[AdminProfileController::class,'AdminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit',[AdminProfileController::class,'EditAdminProfile'])->name('admin.edit.profile');
    Route::post('/admin/profile/store',[AdminProfileController::class,'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password',[AdminProfileController::class,'AdminCpassword'])->name('admin.cpassword');
    Route::post('/admin/update/password',[AdminProfileController::class,'AdminUpdatePassword'])->name('admin.update.password');


// User All Route

Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard',compact('user'));
})->name('dashboard');

Route::get('/',[IndexController::class,'Index']);
Route::get('/user/logout',[IndexController::class,'UserLogout'])->name('user.logout');
Route::get('/user/profile',[IndexController::class,'UserProfile'])->name('user.profile');
Route::post('/user/profile/store',[IndexController::class,'UserProfileStore'])->name('user.profile.store');
Route::get('/user/changepassword',[IndexController::class,'UserChangePassword'])->name('change.password');
Route::post('user/updatepassword',[IndexController::class,'UpdatePassword'])->name('user.updatepassword');

// Admin Brands

Route::prefix('brands')->group(function(){
    
    Route::get('/view',[BrandController::class,'ViewBrand'])->name('all.brands');
    Route::post('/store',[BrandController::class,'BrandStore'])->name('brand.store');
    Route::get('edit/{id}',[BrandController::class,'EditBrand'])->name('edit.brand');
    Route::post('update/',[BrandController::class,'UpdateBrand'])->name('brand.update');
    Route::get('delete/{id}',[BrandController::class,'DeleteBrand'])->name('delete.brand');


});



Route::prefix('category')->group(function(){


// All category

    Route::get('/view',[CategoryController::class,'ViewCategory'])->name('all.category');
    Route::post('/store',[CategoryController::class,'CategoryStore'])->name('category.store');
    Route::get('edit/{id}',[CategoryController::class,'EditCategory'])->name('edit.category');
    Route::post('/update',[CategoryController::class,'CategoryUpdate'])->name('category.update');
    Route::get('delete/{id}',[CategoryController::class,'DeleteCategory'])->name('delete.category');


//All Sub Category


    Route::get('/view/subcategory',[SubCategoryController::class,'ViewSubCategory'])->name('all.subcategory');
    Route::post('/subcategory/store',[SubCategoryController::class,'StoreSubCategory'])->name('subcategory.store');
    Route::get('/subcategory/edit/{id}',[SubCategoryController::class,'EditSubCategory'])->name('edit.subcategory');
    Route::post('/sub/update/{id}',[SubCategoryController::class,'SubCatUpdate'])->name('subcategory.update');
    Route::get('/delete/subcategory/{id}',[SubCategoryController::class,'delete'])->name('delete.subcategory');

// All Sub Subcategory

    Route::get('/view/sub/subcategory',[SubCategoryController::class,'ViewSubSub'])->name('all.subsubcategory');
    Route::get('/subcategory/ajax/{category_id}',[SubCategoryController::class,'GetSubCategory']);
    Route::get('/sub-subcategory/ajax/{subcategory_id}',[SubCategoryController::class,'GetSubSubCategory']);
    Route::post('/subsubcategory/store',[SubCategoryController::class,'subsubcategory'])->name('subsubcategory.store');
    Route::get('edit/subsubcategory/{id}',[SubCategoryController::class,'editsubsub'])->name('edit.subsubcategory');
    Route::post('/update/subsubcategory/',[SubCategoryController::class,'update'])->name('subsubcategory.update');
    Route::get('/delete/subsubcategory/{id}',[SubCategoryController::class,'SubSubDelete'])->name('delete.subsubcategory');


});



///////////////////// All Products Route//////////////////////////////////

Route::prefix('product')->group(function(){
    
    Route::get('/addproduct',[ProductController::class,'AddProduct'])->name('add.product');
    Route::post('/store',[ProductController::class,'ProductStore'])->name('product.store');
    Route::get('product/manage',[ProductController::class,'manage'])->name('manage.product');
    Route::get('edit/product/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::post('update/',[ProductController::class,'update'])->name('product.update');
    Route::get('inactive/{id}',[ProductController::class,'inactive'])->name('product.inactive');
    Route::get('active/{id}',[ProductController::class,'active'])->name('product.active');
    Route::get('delete/{id}',[ProductController::class,'delete'])->name('product.delete');
});

Route::prefix('slider')->group(function(){

    Route::get('view/',[SliderController::class,'view'])->name('manage.slider');
    Route::post('/store',[SliderController::class,'store'])->name('slider.store');
    Route::get('/edit/{id}',[SliderController::class,'edit'])->name('edit.slider');
    Route::post('update/{id}',[SliderController::class,'update'])->name('slider.update');
    Route::get('delete/{id}',[SliderController::class,'delete'])->name('delete.slider');
    Route::get('inactive/{id}',[SliderController::class,'inactive'])->name('slider.inactive');
    Route::get('active/{id}',[SliderController::class,'active'])->name('slider.active');
});

////////////////////////Frontend Routes///////////////////////////////////
///////////////////////////Multi Language Route////////////////////////////////

Route::get('english/language',[LanguageController::class,'english'])->name('english.language');
Route::get('hindi/language',[LanguageController::class,'hindi'])->name('hindi.language');

Route::get('product/details/{id}/{slug}',[IndexController::class,'ProductDetails']);

//////////Products Tags Route//////////////////
Route::get('product/tag/{tags}',[IndexController::class,'TagsWiseProducts']);

/////////////////Frontend Subcategory Wise Data//////////////////////////

Route::get('subcategory/product/{subcat_id}/{slug}',[IndexController::class,'SubcatWiseProducts']);


Route::get('subsubcategory/product/{subsubcat_id}/{slug}',[IndexController::class,'SubSubcatWiseProducts']);

Route::get('/product/view/modal/{id}',[IndexController::class,'productviewajax']);

Route::post('/cart/data/store/{id}',[CartController::class,'AddToCart']);

//Get Data From Mini Cart
Route::get('/product/minicart/{id}',[CartController::class,'minicart']);


//Remove product From MiniCart


Route::get('/minicart/product/remove/{rowId}',[CartController::class,'minicartRemove']);

//WishList
Route::post('/add-to-wishlist/{product_id}',[WishListController::class,'wishlist']);

// Route::get('/wishlistview',[WishListController::class,'wishlistView'])->name(['wishlistview']);

Route::group(['prefix'=>'user','middleware'=>['user','auth'],'namespace'=>'User'],
function()
{
Route::get('/view/list',[WishListController::class,'viewlist'])->name('viewlist');

Route::get('/get-wishlist',[WishListController::class,'getwishlist'])->name('viewlist');

Route::get('/mycart',[MyCartController::class,'viewmycart'])->name('mycart');    

Route::get('/get-cart-product',[MyCartController::class,'getmycart']);   

Route::get('/stripe/order',[StripeController::class,'stripeorder'])->name('stripe.store');


});

Route::prefix('coupon')->group(function(){

    Route::get('view/',[CouponController::class,'viewcoupon'])->name('manage.coupon');
    
    Route::post('/store',[CouponController::class,'storecoupon'])->name('coupon.store');

    Route::get('coupon/edit/{id}',[CouponController::class,'edit'])->name('coupon.edit');
    
    Route::post('coupon/update/{id}',[CouponController::class,'update'])->name('coupon.update');

});

Route::prefix('shipping')->group(function(){

/////////////////////////////Shipping Division//////////////////////////////

    Route::get('/division/view/',[ShippingAreaController::class,'divisionarea'])->name('manage.division');

    Route::post('/division/store',[ShippingAreaController::class,'storedivision'])->name('division.store');

    Route::get('/division/edit/{id}',[ShippingAreaController::class,'editdivision'])->name('division.edit');

    Route::post('/division/update/{id}',[ShippingAreaController::class,'updatedivision'])->name('division.update');

    Route::get('/division/delete/{id}',[ShippingAreaController::class,'deletedivision'])->name('division.delete');

////////////Shipping District///////////////////////////////////////////

    Route::get('/district/view/',[ShippingAreaController::class,'districtarea'])->name('manage.district');

    Route::post('/district/store',[ShippingAreaController::class,'storedistrict'])->name('district.store');

    Route::get('/district/edit/{id}',[ShippingAreaController::class,'editdistrict'])->name('district.edit');

    Route::post('/district/update/{id}',[ShippingAreaController::class,'updatedistrict'])->name('district.update');

    Route::get('/district/delete/{id}',[ShippingAreaController::class,'deletedistrict'])->name('district.delete');

/////////////////////////Shipping State/////////////////////////////////

    Route::get('/state/view/',[ShippingAreaController::class,'statearea'])->name('manage.state');

    Route::post('/state/store',[ShippingAreaController::class,'storestate'])->name('state.store');

    Route::get('/state/edit/{id}',[ShippingAreaController::class,'stateedit'])->name('state.edit');

    Route::post('/state/update/{id}',[ShippingAreaController::class,'updatestate'])->name('state.update');

    Route::get('/state/delete/{id}',[ShippingAreaController::class,'deletestate'])->name('state.delete');

});

/////////////Frontend Coupon Option////////////////////////////

    Route::post('/coupon_apply',[CartController::class,'couponapply']);

    Route::get('/coupon-calculation',[CartController::class,'couponcal']);    

    Route::get('/coupon-remove',[CartController::class,'couponremove']);    

//////////////////Check Out Routes//////////////////////////////

    // Route::get('/checkout/',[CartController::class,'checkoutcreate'])->name('checkout');    

    // Route::get('/district-get/ajax/{division_id}',[CheckOutController::class,'getdistrict']);    

    // Route::get('/state-get/ajax/{district_id}',[CheckOutController::class,'getstate']);    


    // Route::post('/checkout/store',[CheckOutController::class,'checkoutstore'])->name('checkout_store');

    // Route::post('stripe/store',CheckOutController::class,'')->name('stripe.store');
