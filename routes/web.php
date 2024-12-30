<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyRequestController;
use App\Http\Controllers\DetailPropertiController;
use App\Http\Controllers\DJualSewaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MatchListingController;
use App\Http\Controllers\MyListingController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrimaryController;
use App\Http\Controllers\PropertiBaruController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\SecondaryController;
use App\Http\Controllers\UserController;
use App\Models\Property;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/generate-pdf', [PDFController::class, 'generatePdf'])->name('generate-pdf');

// Route::get('/', [HomeController::class, 'index']);

Route::get('/', function () {
    return view('user.home');
})->name('home');

// Route::prefix('proyek-baru')->group(function () {
//     Route::get('/', [PrimaryController::class, 'index'])->name('primary.new');
//     Route::get('/{slug}', [PrimaryController::class, 'show'])->name('primary.bySlug');
//     Route::get('/arah/{direction?}', [PrimaryController::class, 'getPropertyDirection'])->name('primary.byDirection');
//     Route::get('/properties', [PrimaryController::class, 'getProperties'])->name('properties.pagination');
// });


Route::get('/jual', [DjualSewaController::class, 'viewJual'])->name('djual.show');
Route::get('/sewa', [DjualSewaController::class, 'viewSewa'])->name('dsewa.show');

Route::prefix('property-baru')->group(function () {
    Route::get('/{transactionType}', [SecondaryController::class, 'index'])
    ->where('transactionType', 'dijual|disewa')
    ->name('secondary.new');
});

Route::get('/kpr', function () {
    return view('user.kpr', ['title' => 'KPR']);
});

Route::get('/tentang', function () {
    return view('user.about');
});

Route::get('/my-listing', function () {
    return view('user.my-listing');
});

Route::get('/properti-detail/{id}', [DetailPropertiController::class, 'show'])->name('property.detail');

Route::get('/properti', function () {
    return view('user.property.property');
});

Route::get('/property/{id}', [PropertyController::class, 'show'])->name('property.show');

Route::get('/', [PropertyController::class, 'index'])->name('home');
Route::get('/search', [PropertyController::class, 'homeSearch'])->name('property.search');

// Route::get('/register', [AuthController::class, 'store'])->name('register.view');
// Route::post('/register/submit', [AuthController::class, 'submitStore'])->name('register.submit');

Route::get('/login', [AuthController::class, 'loginView'])->name('login.view');
Route::post('/login/submit', [AuthController::class, 'submitLogin'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/profil/{id}', [UserController::class, 'profilView'])->name('user.profil');
Route::get('/profil/edit/{id}', [UserController::class, 'profilEditView'])->name('user.profil.edit');
Route::post('/profil/submit/{id}', [UserController::class, 'submitProfil'])->name('user.edit');

Route::get('/properti/add', [PropertyController::class, 'addSecondary'])->name('add.view');
Route::post('/properti/submit', [PropertyController::class, 'submitSecondary'])->name('add.submit');

Route::get('/update-property-secondary/{propertyID}/{id}', [PropertyController::class, 'viewUpdatePropertySecondary'])->name('updateSecondaryUser.view');
Route::post('/update-property-secondary/{id}/submit', [PropertyController::class, 'updateSecondaryUser'])->name('updateSecondaryUser.submit');

Route::get('/properti/add-primary', [PropertyController::class, 'addPrimary'])->name('addPrimary.view');
Route::post('/properti/submit-primary', [PropertyController::class, 'submitPrimary'])->name('addPrimary.submit');

Route::get('/update-property-primary/{propertyID}/{id}', [PropertyController::class, 'viewUpdatePropertyPrimary'])->name('updatePrimaryUser.view');
Route::post('/update-property-primary/{id}/submit', [PropertyController::class, 'updatePrimaryUser'])->name('updatePrimaryUser.submit');

Route::get('/jual/search', [DJualSewaController::class, 'jualSearch'])->name('property.jualSearch');
Route::get('/sewa/search', [DJualSewaController::class, 'sewaSearch'])->name('property.sewaSearch');
Route::get('/myListing/{id}', [MyListingController::class, 'myListingView'])->name('myListing.view');
Route::get('/myListing/{id}/search', [MyListingController::class, 'myListingSearch'])->name('property.myListingSearch');
Route::get('/list-property-menunggu-verifikasi/{id}', [PropertyController::class, 'listKonfirmasi'])->name('listKonfirmasi.view');
Route::get('/properti-baru', [PropertiBaruController::class, 'viewPrimary'])->name('pbaru.show');
Route::get('/properti-baru/search', [PropertiBaruController::class, 'primarySearch'])->name('property.primarySearch');

Route::get('/buy-request/{id}', [BuyRequestController::class, 'show'])->name('BuyRequest.view');
Route::POST('/delete-request/{id}', [BuyRequestController::class, 'deleteRequest'])->name('BuyRequest.delete');
Route::get('/new-request/{id}', [BuyRequestController::class, 'addView'])->name('addRequest.view');
Route::post('/new-request/{id}/submit', [BuyRequestController::class, 'addSubmit'])->name('addRequest.submit');
Route::get('/edit-request/{id}', [BuyRequestController::class, 'editRequestShow'])->name('editRequest.view');
Route::post('/edit-request{id}/submit', [BuyRequestController::class, 'editRequest'])->name('editRequest.submit');

Route::get('/view-matched/{userId}/{requestID}', [BuyRequestController::class, 'viewMatched'])->name('viewMatched');

Route::get('/match-listing/{userId}', [MatchListingController::class, 'show'])->name('matchListing.view');

Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// ADMIN PAGE SECTION

Route::get('/dashboard', [UserController::class, 'adminHome'])->name('admin.home');

Route::get('/users-list', function () {
    return app(UserController::class)->adminProfilView();
})->name('admin-users.profil');
Route::get('/users-list/search', [UserController::class, 'userSearch'])->name('userSearch');
Route::get('/add-users', [UserController::class, 'viewAddUser'])->name('addUser.view');
Route::get('/ubah-user/{id}', [UserController::class, 'viewUpdateUser'])->name('updateUser.view');

Route::post('/add-users/submit', [UserController::class, 'addUser'])->name('addUser.submit');
Route::post('/ubah-user/{id}/submit', [UserController::class, 'updateUser'])->name('updateUser.submit');
Route::post('/delete-users/{id}', function ($id) {
    return app(UserController::class)->destroy($id);
})->name('users.delete');

Route::get('/property-verification', [PropertyController::class, 'propertyVerifView'])->name('propertyVerif.view');

Route::get('/property-primary', [PropertyController::class, 'propertyPrimaryView'])->name('propertyPrimary.view');
Route::get('/property-primary/search', [PropertiBaruController::class, 'primaryAdminSearch'])->name('propertyPrimary.search');
Route::get('/property-secondary', [PropertyController::class, 'propertySecondaryView'])->name('propertySecondary.view');
Route::get('/property-secondary/search', [PropertyController::class, 'secondarySearch'])->name('propertySecondary.search');

Route::get('/add-property-primary', [PropertyController::class, 'viewAddProperty'])->name('addProperty.view');
Route::get('/add-property-secondary', [PropertyController::class, 'viewAddSecondary'])->name('addSecondary.view');

Route::get('/ubah-property/{propertyID}', [PropertyController::class, 'viewUpdateProperty'])->name('updateProperty.view');
Route::get('/ubah-property-secondary/{propertyID}', [PropertyController::class, 'viewUpdateSecondary'])->name('updateSecondary.view');

Route::get('/buy-request', [BuyRequestController::class, 'viewAll'])->name('allBuyRequest.view');
Route::get('/request-matched/{agentID}/{requestID}', [BuyRequestController::class, 'viewRequestMatched'])->name('viewRequestMatched');
Route::get('/request-baru', [BuyRequestController::class, 'viewRequestBaru'])->name('requestBaru.view');

Route::get('/match-listing-admin/{agentID}', [MatchListingController::class, 'showMatchListing'])->name('showMatchListing.view');

Route::post('/property-verification-primary/{id}/submit', [PropertyController::class, 'acceptPrimary'])->name('acceptPrimary');
Route::post('/property-verification-secondary/{id}/submit', [PropertyController::class, 'acceptSecondary'])->name('acceptSecondary');

Route::post('/add-property-primary/submit', [PropertyController::class, 'addListPrimary'])->name('addListPrimary.submit');
Route::post('/add-property-secondary/submit', [PropertyController::class, 'addListSecondary'])->name('addListSecondary.submit');

Route::post('/ubah-property-primary/{id}/submit', [PropertyController::class, 'updatePrimary'])->name('updatePrimary.submit');
Route::post('/ubah-property-secondary/{id}/submit', [PropertyController::class, 'updateSecondary'])->name('updateSecondary.submit');

Route::post('/delete-primary/{id}', [PropertyController::class, 'rejectPrimary'])->name('rejectPrimary');
Route::post('/delete-secondary/{id}', [PropertyController::class, 'rejectProperty'])->name('rejectProperty');
Route::post('/delete-list-primary/{id}', [PropertyController::class, 'deleteListPrimary'])->name('deleteListPrimary');
Route::post('/delete-list-secondary/{id}', [PropertyController::class, 'deleteListSecondary'])->name('deleteListSecondary');

Route::post('/request-baru/{id}/submit', [BuyRequestController::class, 'requestBaru'])->name('requestBaru.submit');

Route::get('/laporan/buy-request/', [LaporanController::class, 'viewLaporanBuyRequest'])->name('laporanBuyRequest.view');
Route::get('/laporan/buy-request/search', [LaporanController::class, 'searchLaporanBuyRequest'])->name('laporanBuyRequest.submit');

Route::post('/laporan/pdf/buy-request', [LaporanController::class, 'viewExportToPDF'])->name('streamPDF.view');
Route::post('/export/pdf', [LaporanController::class, 'exportToPDF'])->name('streamPDF.submit');

