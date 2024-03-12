<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\PropertyController;
use Illuminate\Support\Facades\Input;
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

Route::get('chat', function () {
    return view('chat');
});
Route::get('sample', function () {
    return view('sample');
});

/* Route::get('viewproperty', function () {
    return view('viewproperty');
}); */

Route::get('/chat/{property}', [AccountController::class, 'showChat'])->name('chat.show');
Route::post('/chat/send', [AccountController::class, 'sendMessage'])->name('chat.send');

// Route::get('/chat', [AccountController::class, 'showChat'])->name('chat.show');
// Route::post('/send-message', [AccountController::class, 'sendMessage'])->name('chat.sendMessage');

// Routes for Login and Register
Route::middleware(['web'])->group(function () {
    Route::post('login', [AccountController::class, 'loginPost'])->name('login.post');
    Route::get('login', [AccountController::class, 'login'])->name('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('logout', [AccountController::class, 'logout'])->name('logout');
});

Route::prefix('register')->group(function () {
    Route::get('landlord', [AccountController::class, 'landlordregister'])->name('landlordregister');
    Route::get('tenant', [AccountController::class, 'tenantregister'])->name('tenantregister');
    Route::post('landlord', [AccountController::class, 'llregister'])->name('landlordregister.post');
    Route::post('tenant', [AccountController::class, 'ttregister'])->name('tenantregister.post');
});

//tenant
Route::prefix('tenant')->middleware(['auth', 'tenant'])->group(function () {
    Route::get('index', [PropertyController::class, 'index'])->name('index');
    Route::post('index', [PropertyController::class, 'showindex'])->name('showindex.post')->middleware('verified.owner');

    Route::get('showproperty', [PropertyController::class, 'showproperty'])->name('showproperty');
    Route::post('showproperty', [PropertyController::class, 'showrentals'])->name('showrentals.post');

    Route::get('/viewproperty/{id}', [PropertyController::class, 'viewproperty'])->name('viewproperty');
    Route::post('viewproperty', [PropertyController::class, 'viewone'])->name('viewone.post');

    Route::get('aboutus', [AccountController::class, 'aboutus'])->name('aboutus');


    Route::get('profile',[ContractController::class, 'profile'])->name('profile');
    Route::get('/download-contract/{id}', [ContractController::class, 'downloadContract'])->name('tenant.download.contract');
    Route::post('/tupload-contract/{id}', [ContractController::class, 'uploadContract'])->name('tenant.upload.contract');

    Route::post('inquire', [ContractController::class, 'inquire'])->name('inquire.post');
});

// Routes for Owner
Route::prefix('owner')->middleware(['auth', 'owner'])->group(function () {

    Route::post('/properties/{id}/restore', [AccountController::class, 'restore'])->name('properties.restore');

    Route::get('manageContract', [ContractController::class, 'manageContract'])->name('manageContract');

    Route::get('/showpayment', [ContractController::class, 'showpayment'])->name('showpayment');

    Route::post('/payment/{contractId}', [ContractController::class, 'submitpayment'])->name('payment.submit');
    Route::get('/paymentform/{contractId}', [ContractController::class, 'paymentform'])->name('paymentform');

    Route::post('paymentformPost', [ContractController::class, 'paymentformPost'])->name('paymentformPost');
    Route::get('createproperty', [PropertyController::class, 'createproperty'])->name('createproperty')->middleware('verified.owner');
    Route::post('createproperty', [PropertyController::class, 'propertylisting'])->name('propertylisting.post');

    Route::get('imagesproperty', [PropertyController::class, 'imagesproperty'])->name('imagesproperty')->middleware('verified.owner');;
    Route::post('imagesproperty', [PropertyController::class, 'addimages'])->name('addimages.post');

    Route::get('/{property}/updateproperty', [PropertyController::class, 'updateproperty'])->name('property.updateproperty');
    Route::put('/updateproperty/{id}', [PropertyController::class, 'updatepropertyform'])->name('properties.updatepropertyform');
    Route::delete('/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');

    Route::post('/inquiries/{id}/reject', [ContractController::class, 'rejectInquiry'])->name('inquiries.reject');
    Route::post('/inquiries/{id}/accept', [ContractController::class, 'acceptInquiry'])->name('inquiries.accept');

    Route::get('/tenantcontract', [ContractController::class, 'tenantcontract'])->name('tenantcontract');
    Route::post('/tenantcontract/{inquiry_id}', [ContractController::class, 'createcontract'])->name('createcontract');
    Route::get('user',[AccountController::class, 'users'])->name('user');

    Route::get('inquiriesform', [ContractController::class, 'inquiriesform'])->name('inquiriesform');
});

Route::get('adminregister',[AccountController::class, 'adminregister'])->name('adminregister');
Route::post('adminregister', [AccountController::class, 'adregister'])->name('adminregister.post');



Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('adminManagement', [AdminController::class, 'adminManagement'])->name('adminManagement');
    Route::get('adminVerification', [AdminController::class, 'adminVerification'])->name('adminVerification');
    Route::get('adminInterface', [AdminController::class, 'adminInterface'])->name('adminInterface');

    Route::patch('owner/{id}', [AdminController::class, 'verifylandlord'])->name('admin.verify.landlord');
    Route::patch('property/{id}', [AdminController::class, 'verifyproperty'])->name('admin.verify.property');

    Route::delete('/owners/{ownerDelete}', [AdminController::class, 'destroyOwner'])->name('admin.destroy.owner');
    Route::delete('/tenants/{tenantDelete}', [AdminController::class, 'destroyTenant'])->name('admin.destroy.tenant');
    Route::delete('/properties/{propertyDelete}', [AdminController::class, 'destroyProperty'])->name('admin.destroy.property');
});







