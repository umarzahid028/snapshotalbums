<?php

use App\Http\Controllers\Frontend\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
// use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\User\ProductController;
use App\Http\Controllers\Admin\ForSaleController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\GoogleDriveController;
use App\Http\Controllers\Admin\AlbumController;
use Illuminate\Http\Request;
use App\Http\Controllers\StripeController;  

use Illuminate\Support\Facades\Artisan;
// use Google\Service\Docs\Request;

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

Route::get('/clear', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
 
    return "Cleared!";
 
 });



//  free access page


// Route to show the secret code form
Route::get('/admin', [DashboardController::class, 'showSecretCodeForm'])->name('admin');

// Route to show the email form after code is verified
Route::get('/free-access', [DashboardController::class, 'showEmailForm'])->name('admin-login');

// Route to process the secret code
Route::post('/processadmin', [DashboardController::class, 'processAdmin'])->name('processAdmin');

// Route to process the email and perform assignment
Route::post('/processlogin', [DashboardController::class, 'processLogin'])->name('processLogin');





 Route::get('/send-before-event-email', [GoogleDriveController::class, 'mail']);
 Route::get('/send-after-event-email', [GoogleDriveController::class, 'mail']);


// Main


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
     Artisan::call('config:clear');
     Artisan::call('view:clear');
    return 'Cache cleared successfully.';
});

Route::get('/run-composer-command', function () {
    $output = shell_exec('/usr/local/bin/composer dump-autoload');
    return "<pre>{$output}</pre>";
});

Auth::routes();


Route::get('/testing', function () {
    return view('frontend.file');
});

Route::get('/', function () {
    return view('frontend.index');
});


Route::get('google/login',[GoogleDriveController::class,'googleLogin'])->name('google.login');
Route::get('auth/google/callback', [GoogleDriveController::class,'googleCallback'])->name('google.callback');

Route::post('google-drive/create-folder',[GoogleDriveController::class,'googleDriveCreateFolder'])->name('google.drive.create.folder');

Route::post('google-drive/file-upload',[GoogleDriveController::class,'googleDriveFileUpload'])->name('google.drive.file-upload');

Route::get('upload/{folder_id}/{user_id}', [GoogleDriveController::class, 'Upload'])->name('upload');

Route::get('gallery/{folder_id}/{user_id}', [AlbumController::class, 'gallery'])->name('gallery');

Route::post('google-drive/file-upload-out-side',[GoogleDriveController::class,'googleDriveFileUploadOutSide'])->name('google.drive.file-upload-out-side');


Route::get('/pricing', function () {
    return view('frontend.pricing');
});

Route::get('/faq', function () {
    return view('frontend.faq');
});

// Route::get('/about_us', function () {
//     return view('frontend.about-us');
// });


Route::get('/tutorial', function () {
    return view('frontend.tutorial');
});

Route::get('/privacy_policy', function () {
    return view('frontend.privacy-policy');
});

Route::get('/terms', function () {
    return view('frontend.terms');
});

Route::get('/contact-us', function () {
    return view('frontend.contact-us');
});







Route::get('/templates', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect('/login')->with('error', 'Please login to access this page.');
    }

    // Check if user is on the premium plan
    if ($user->plan !== 'premium') {
        return redirect('/pricing')->with('error', 'Canva Templates are only available to Premium users. Upgrade your plan to access.');
    }

    return view('frontend.templates');
});







Route::post('/contact', [StripeController::class, 'store'])->name('contact.store');



Route::group(['middleware' => 'auth'], function () {
    Route::resource('myprofile', 'Admin\SettingsController');
    Route::resource('album', 'Admin\AlbumController');
    
    



Route::get('stripe', [StripeController::class, 'stripe'])->name('admin.stripe');
Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');


});


Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => ['auth', 'user']], function (){
    // Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('dashboard', 'DashboardController');
    Route::resource('product', 'ProductController');
    Route::resource('order', 'OrderController');
    Route::get('order_place/{id}', [ProductController::class,'edit'])->name('order_place');
    Route::resource('invoice', 'InvoiceController');
    Route::resource('settings', 'SettingsController');
    Route::resource('profile', 'ProfileController');
    
});




// Routes accessible to authenticated users only
Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', 'Admin\DashboardController'); // Assuming your DashboardController is in the "Admin" namespace
    Route::post('/toggle-renew-status/{userId}',[DashboardController::class, 'toggleRenewStatus'])->name('toggle.renew.status');
    Route::get('/user/account', [DashboardController::class, 'account'])->name('user.account');



    
    Route::get('stripe', [StripeController::class, 'stripe'])->name('admin.stripe');
    Route::post('stripe', [StripeController::class, 'stripePost'])->name('stripe.post');


});




Route::middleware(['auth'])->group(function () {
    Route::get('/subscribe', [StripeController::class, 'showSubscriptionForm'])->name('subscribe.form');
    Route::post('/subscribe', [StripeController::class, 'subscribeToPlan'])->name('subscribe.plan');
});

