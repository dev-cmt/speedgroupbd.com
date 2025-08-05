<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\BlogController;

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


//___________________________________// START \\______________________________________________//
Route::get('/', [HomeController::class, 'welcome'])->name('/');

/**______________________________________________________________________________________________
 * View Page => ALL
 * ______________________________________________________________________________________________
 */
Route::get('comming/soon', [HomeController::class, 'comming_soon'])->name('comming_soon');
//______________ ABOUT US
Route::get('page/about-us', [HomeController::class, 'about'])->name('page.about-us');
//______________ PACKAGE
Route::get('page/package', [HomeController::class, 'package'])->name('page.package');
Route::get('page/package-details', [HomeController::class, 'packageDetails'])->name('page.package-details');

Route::get('/package-details-multicity', function () {
    return view('frontend.pages.package-details-multicity');
})->name('page.package-details-multicity');

//______________ GALLERY
Route::get('page/gallery-image',[HomeController::class,'galleryImage'])->name('page.gallery-cover');
Route::get('page/gallery-image/{id}/show',[HomeController::class,'galleryShow'])->name('page.gallery-show');
//______________ BLOG
Route::get('page/news-content', [HomeController::class, 'blog'])->name('page.blog');
Route::get('page/news-content-details/{id}', [HomeController::class, 'blogDetails'])->name('page.blog-details');

//______________ CONTACT US
Route::get('page/contact-us', [HomeController::class, 'contact'])->name('page.contact-us');
Route::post('contact-us/store', [ContactController::class,'contactStore'])->name('contact-us.store');
//______________ BOOKING NOW
Route::get('page/booking-now', [HomeController::class, 'bookingNow'])->name('page.booking-now');
Route::post('page/booking-now/store', [HomeController::class, 'bookingNowStore'])->name('booking-now.store');
//______________ OTHER
Route::get('page/terms-condition', [HomeController::class, 'termsCondition'])->name('page.terms-condition');
Route::get('page/privacy-policy', [HomeController::class,'privacyPolicy'])->name('page.privacy-policy');


/**______________________________________________________________________________________________
 * Login Check => Dashboard
 * ______________________________________________________________________________________________
 */
Route::middleware([ 'auth:sanctum','verified','member', config('jetstream.auth_session')])->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('page/member-all', [AdminController::class, 'member'])->name('page.member-all');
    Route::get('page/member-search', [AdminController::class,'memberSearch'])->name('page.member-search');
    
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});

/* Payment check */
Route::group(['middleware' => ['verified']], function () {
    Route::get('/registation-payment/create', [TransactionController::class, 'createRegistation'])->name('registation-payment.create');
    Route::post('/registation-payment/store', [TransactionController::class, 'storeRegistation'])->name('registation-payment.store');
});


/*
|--------------------------------------------------------------------------
| Profile Setting
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth']], function(){
    Route::get('member-prifile/{id}/show', [ProfileController::class, 'profile_show'])->name('profile_show');
    Route::put('member-prifile/other_info/{id}/update', [ProfileController::class, 'infoOtherUpdate'])->name('info_other.update');
    Route::post('member-prifile/change-password/{id}', [ProfileController::class, 'changePassword'])->name('change.password');
    Route::get('info_member/edit/{id}', [ProfileController::class, 'member_edit'])->name('info_member.edit');
    Route::post('info_member/update/{id}', [ProfileController::class, 'member_update'])->name('info_member.update');
});


Route::group(['middleware' => ['auth']], function(){
    /**______________________________________________________________________________________________
     * TRANSACTION => MENU
     * ______________________________________________________________________________________________
     */
    //-- TRANSACTION => MEMBER REGISTATION
    Route::get('transaction-registation/approve/index', [TransactionController::class,'approveIndexRegistation'])->name('transaction-registation-approve.index');
    Route::PATCH('transaction-registation/{id}/approve', [TransactionController::class, 'approveRegistationApproved'])->name('transaction-registation.approve');
    Route::PATCH('transaction-registation/{id}/cancel', [TransactionController::class, 'approveRegistationCancel'])->name('transaction-registation.cancel');
    Route::get('transaction-registation/{id}/details', [TransactionController::class, 'approveRegistrationDetails'])->name('transaction-registration.details');
    Route::get('download/transaction-registation/{id}', [TransactionController::class, 'downloadSlip'])->name('transaction-document.download');

    //-- TRANSACTION => EVENT REGISTATION
    Route::get('transaction-event/index', [TransactionController::class,'indexEventRegistation'])->name('transaction-event.index');
    Route::get('transaction-event/{id}/create', [TransactionController::class,'createEventRegistation'])->name('transaction-event.create');

    Route::get('transaction-event-approve/index', [TransactionController::class,'approveIndexEvent'])->name('transaction-event-approve.index');
    Route::PATCH('transaction-event/{id}/approve', [TransactionController::class, 'approveEventApproved'])->name('transaction-event.approve');
    Route::PATCH('transaction-event/{id}/cancel', [TransactionController::class, 'approveEventCancel'])->name('transaction-event.cancel');
    Route::get('transaction-event/{id}/details', [TransactionController::class, 'approveEventDetails'])->name('transaction-event.details');
    
    //-- TRANSACTION => ANNUAL REGISTATION
    Route::get('transaction-annual/index', [TransactionController::class,'indexAnnualFees'])->name('transaction-annual.index');
    Route::get('transaction-annual/create', [TransactionController::class,'createAnnualFees'])->name('transaction-annual.create');

    Route::get('transaction-annual-approve/index', [TransactionController::class,'approveIndexAnnualFees'])->name('transaction-annual-approve.index');
    Route::PATCH('transaction-annual/{id}/approve', [TransactionController::class, 'approveAnnualFeesApproved'])->name('transaction-annual.approve');
    Route::PATCH('transaction-annual/{id}/cancel', [TransactionController::class, 'approveAnnualFeesCancel'])->name('transaction-annual.cancel');
    Route::get('transaction-annual/{id}/details', [TransactionController::class, 'approveAnnualFeesDetails'])->name('transaction-annual.details');
    
    //-- MASTER SETTING =>> PAYMENT NUMBER
    Route::get('master/transaction-payment/number/index',[TransactionController::class,'indexPaymentNumber'])->name('transaction-payment-number.index');
    Route::post('master/transaction-payment/number/store',[TransactionController::class,'storePaymentNumber'])->name('transaction-payment-number.store');
    Route::get('master/transaction-payment/number/edit',[TransactionController::class,'editPaymentNumber'])->name('transaction-payment-number.edit');
    Route::get('master/transaction-payment/number/delete',[TransactionController::class,'deletePaymentNumber'])->name('transaction-payment-number.delete');
    Route::get('get/payment-number',[TransactionController::class,'getPaymentNumber'])->name('get-payment-number');
    //-- MASTER SETTING =>> PAYMENT FEE
    Route::get('master/transaction-payment/fees/index',[TransactionController::class,'indexPaymentFees'])->name('transaction-payment-fees.index');
    Route::get('master/transaction-payment/fees/edit',[TransactionController::class,'editPaymentFees'])->name('transaction-payment-fees.edit');
    Route::post('master/transaction-payment/fees/store',[TransactionController::class,'storePaymentFees'])->name('transaction-payment-fees.store');
    /**______________________________________________________________________________________________
     * POST => MENU
     * ______________________________________________________________________________________________
     */
    //-- GALLERY
    Route::resource('gallery', GalleryController::class);
    Route::delete('gallery-destroy/{id}',[GalleryController::class,'destroy'])->name('gallery.destroy');
    Route::delete('gallery-deleteimage/{id}',[GalleryController::class,'deleteimage'])->name('gallery.deleteimage');
    Route::delete('gallery-deletecover/{id}',[GalleryController::class,'deletecover'])->name('gallery.deletecover');

    Route::get('/download/{id}', [GalleryController::class, 'downloadFile'])->name('gallery.download');
    Route::get('/dowloads', [GalleryController::class, 'dowloads']);

    Route::get('dashboard-gallery/all',[GalleryController::class,'bvGallery'])->name('dashboard-gallery.all');
    Route::get('dashboard-gallery/{id}/show',[GalleryController::class,'bvGalleryImage'])->name('dashboard-gallery.images');

    //-- BLOG
    Route::get('blog-news/index', [BlogController::class,'index'])->name('blog.index');
    Route::get('blog-news/create', [BlogController::class,'create'])->name('blog.create');
    Route::post('blog-news/store', [BlogController::class,'store'])->name('blog.store');
    Route::get('blog-news/edit/{blog}', [BlogController::class,'edit'])->name('blog.edit');
    Route::put('blog-news/update/{blog}', [BlogController::class,'update'])->name('blog.update');
    Route::get('blog-news/show/{blog}', [BlogController::class,'show'])->name('blog.show');
    Route::delete('blog-news/delete/{id}', [BlogController::class,'destroy'])->name('blog.delete');

    //-- CONTACT
    Route::get('contact-us/index', [ContactController::class,'contactIndex'])->name('contact-us.index');
    Route::get('contact-us/{id}/reply', [ContactController::class,'contactReply'])->name('contact-us.reply');
    Route::get('contact-us/{id}/delete', [ContactController::class,'contactDelete'])->name('contact-us.delete');

});
