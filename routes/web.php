<?php

use App\Http\Controllers\Annee\AnneeController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\dashboard\DashController;
use App\Http\Controllers\Etudiant\EtudiantController;
use App\Http\Controllers\Isncription\InscriptionController;
use App\Http\Controllers\Modalite\ModaliteController;
use App\Http\Controllers\Option\OptionController;
use App\Http\Controllers\Payement\PayementController;
use App\Http\Controllers\Promotion\PromotionController;
use App\Http\Controllers\Rapport\RapportController;
use App\Http\Controllers\Type\TypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login.index');
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login')->name('auth.login');
    Route::get('/logout', 'logout')->name('logout');
    Route::get('/getUsers', 'getUsers')->name('user.index');
    Route::post('/createUser', 'store')->name('user.create');
    Route::put('/user/{user}', 'update')->name('user.update');
    Route::delete('/user/{id}', 'destroy')->name('user.destroy');
});

Route::controller(DashController::class)->group(function () {
    Route::get('/dashboard', 'index')->name('dashBoard.index');
});

Route::controller(EtudiantController::class)->group(function () {
    Route::get('/etudiant-index', 'getEtudiant')->name('etudiant.index');
    Route::get('/form-store', 'getStoreForm')->name('form.store');
    Route::post('/etudiant-store', 'store')->name('etudiant.store');
    Route::get('/etudiant/{etudiant}/edit', 'edit')->name('etudiant.edit');
    Route::put('/etudiant/{etudiant}', 'update')->name('etudiant.update');
});

Route::controller(OptionController::class)->group(function () {
    Route::get('/option-index', 'IndexOption')->name('option.index');
    Route::get('/option-form', 'FormOption')->name('option.form');
    Route::post('/option-store', 'store')->name('option.store');
    Route::get('/option/{option}/edit', 'edit')->name('option.edit');
    Route::put('/option/{option}', 'update')->name('option.update');
});

Route::controller(AnneeController::class)->group(function () {
    Route::get('/annee-index', 'indexAnnee')->name('annee.index');
    Route::get('/form-option', 'getFormAnnee')->name('formAnnee');
    Route::post('/annee-store', 'store')->name('annee.store');
    Route::get('/annee/{annee}/edit', 'edit')->name('annee.edit');
    Route::put('/annee/{annee}', 'update')->name('annee.update');
});

Route::controller(TypeController::class)->group(function () {
    Route::get('/type-index', 'IndexType')->name('type.index');
    Route::get('/type-form', 'FormType')->name('type.form');
    Route::post('/type-store', 'store')->name('type.store');
    Route::get('/type/{type}/edit', 'edit')->name('type.edit');
    Route::put('/type/{type}', 'update')->name('type.update');
});

Route::controller(InscriptionController::class)->group(function () {
    Route::get('/inscription-index', 'index')->name('inscription.index');
    Route::get('/inscriptions/create', 'create')->name('inscriptions.create');
    Route::post('/inscriptions', 'store')->name('inscriptions.store');
    Route::get('/inscriptions/{id}/edit', 'edit')->name('inscriptions.edit');
    Route::put('/inscriptions/{id}', 'update')->name('inscriptions.update');
    // carte
    Route::get('/inscriptions/{id}/carte', 'carte')->name('inscriptions.carte');
});

Route::controller(PromotionController::class)->group(function () {
    Route::get('/promotion-index', 'promotionIndex')->name('promotion.index');
    Route::get('/promotion-form', 'promotionForm')->name('promotion.form');
    Route::post('/store-option', 'storeOption')->name('store.option');
    Route::post('/promotion-store', 'storePromotion')->name('promotion.store');
    Route::get('/promotion/{id}/edit', 'edit')->name('promotion.edit');
    Route::put('/promotion/{id}', 'update')->name('promotion.update');
});

Route::resource('payements', PayementController::class);

Route::controller(RapportController::class)->group(function(){
    Route::get('/rapport-index', 'getRapport')->name('rapport.index');
    Route::get('/rapport-journal','journal')->name('rapport.journal');
});

Route::get('/payements/{id}/recu', [PayementController::class, 'recu'])
    ->middleware('auth')
    ->name('payements.recu');

Route::controller(ModaliteController::class)->group(function(){
    Route::get('/modalite-index','index')->name('modalite.index');
    Route::get('/modalite-form','create')->name('modalite.form');
    Route::post('/modalite.store','store')->name('modalite.store');
    Route::get('/modalite/{id}/edit', 'edit')->name('modalite.edit');
    Route::put('/modalite/{id}','update')->name('modalite.update');
});

Route::get('/rapport/selection', [RapportController::class, 'selectionForm'])->name('rapport.selection');
Route::post('/rapport/resultat', [RapportController::class, 'generate'])->name('rapport.generate');
