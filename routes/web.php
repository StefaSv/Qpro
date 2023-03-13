<?php

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



//Route::post("get_mobile_token", [\App\Http\Controllers\AuthenticationController::class, "getMobileToken"]);


Route::get('/', function () {return view('login.login');})->name('login');
Route::post('/login', [\App\Http\Controllers\AuthenticationController::class, "login"]);
Route::get('/login/recovery', function () {return view('login.login_recovery', ['err_login' => false]);});
Route::post('/login/recovery/check', [\App\Http\Controllers\RecController::class, "checklogin"]);



Route::get('/registration', function () {return view('registration.registration');});
Route::post('/registration/set', [\App\Http\Controllers\RegistrationController::class, "set"]);
Route::get('/registration/set-dealers', [\App\Http\Controllers\RegistrationController::class, "setDealers"]);
Route::get('/registration/verification', function () {return view('registration.registration_verification');});
Route::post('/registration/check-phone', [\App\Http\Controllers\RegistrationController::class,'checkPhone']);
Route::get('/registration/choice-DC', function () {return view('registration.registration_choice_DC');});
Route::get('/registration/new-DC', function () {return view('registration.new_DC');});
Route::get('/registration/accepted', function () {return view('registration.registration_accepted');});
Route::get('/registration/completed', function () {return view('registration.registration_completed');});
Route::post('/registration/check', [\App\Http\Controllers\RegistrationController::class,'registrationCheck']);
Route::post('/registration/set-DC', [\App\Http\Controllers\RegistrationController::class,'setDC']);

Route::middleware(['auth'])->group(function(){

    Route::get('/logout',[\App\Http\Controllers\AuthenticationController::class,'logout']);

    Route::get('/profile-DC', function (){return view('profileDC.profile_DC');});
    Route::get('/profile-DC/change', function (){return view('profileDC.profile_DC_change');});
    Route::get('/profile-DC/fill', function (){return view('profileDC.profile_DC_fill');});
    Route::post('/profile-DC/change/set', [\App\Http\Controllers\ProfileDCCintroller::class, 'set']);
    Route::get('/profile-DC/full', function (){return view('profileDC.profile_DC_full');});
    Route::post('/profile-DC/change/send-request', [\App\Http\Controllers\ProfileDCCintroller::class, 'sendRequest']);

    Route::post('/subscription/pay_account', [\App\Http\Controllers\SubscriptionController::class,'payAccount']);
    Route::post('/subscription/compose-check/{id}', [\App\Http\Controllers\SubscriptionController::class,'composeCheck']);
    Route::get('/subscription/check',[\App\Http\Controllers\SubscriptionController::class,'checkSub']);

    Route::get('/profile-data', function (){return view('profile_data');});
    Route::post('/profile-data/set', [\App\Http\Controllers\ProfileUserController::class,'set']);
    Route::post('/profile-data/password-change', [\App\Http\Controllers\ProfileUserController::class,'passwordChange']);
    Route::post('/profile/phone-mail/change-request', [\App\Http\Controllers\ProfileUserController::class, 'phoneMaleChange']);

    Route::get('/sales', function (){return view('sales.sales');});
    Route::get('/sales/profile-manager/{id}', [\App\Http\Controllers\SalesController::class, 'showProfileManager']);
    Route::get('/sales/offer/{id}', [\App\Http\Controllers\SalesController::class, 'showOffer']);
    Route::get('/user/fire/{id}', [\App\Http\Controllers\SalesController::class, 'userFire']);
    Route::get('/user/not-confirm/{id}', [\App\Http\Controllers\SalesController::class, 'userNotConfirm']);
    Route::get('/user/confirm/{id}', [\App\Http\Controllers\SalesController::class, 'userConfirm']);

    Route::get('/advertisement', function (){return view('advertisement.advertisement');});
    Route::post('/advertisement/send_change',[\App\Http\Controllers\AdvertisementController::class, 'sendChange']);
    Route::post('/advertisement/froze',[\App\Http\Controllers\AdvertisementController::class, 'froze']);
    Route::post('/advertisement/unfroze',[\App\Http\Controllers\AdvertisementController::class, 'unfroze']);

    Route::get('/notification', function (){return view('notification');});
    Route::post('/notification/read', [\App\Http\Controllers\NotificationController::class, 'read']);

    Route::get('/support', function (){return view('support');});
    Route::post('/support/send-message',[\App\Http\Controllers\SupportController::class,'sendMessage']);
    Route::get('/support/check-new',[\App\Http\Controllers\SupportController::class,'checkNew']);
    Route::get('/support/get-messages',[\App\Http\Controllers\SupportController::class,'getMessages']);

    Route::get('/statistics', function (){return view('statistics');});
    Route::get('statistics/sort',[\App\Http\Controllers\StatisticController::class, 'sort']);
    Route::get('/datatable', function (){return view('datatable');});

});





Route::get('/dd',function (){
    $user = App\Models\User::where('email', 'kirill12272001@gmail.com')->first();
    $user->password = \Illuminate\Support\Facades\Hash::make('1234566');
    $user->save();
});

Route::get('/add', [\App\Http\Controllers\Adder::class,'makeUser']);
Route::get('/addDeal', [\App\Http\Controllers\Adder::class,'makeDealer']);
Route::get('/addFrozen', [\App\Http\Controllers\Adder::class,'makeFrozen']);
