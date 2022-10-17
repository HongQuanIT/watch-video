<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Base\Template\TemplateController;
use App\Http\Controllers\Base\Template\StorageController;
use App\Http\Controllers\Base\Template\InstallController;
use App\Http\Controllers\Base\Page\PageController;
use App\Http\Controllers\Base\Template\DatabaseController;
use App\Http\Controllers\Base\Template\PDFController;
use App\Http\Controllers\Base\Template\DomObjectController;

// test get template

// Route::post('/test/{id_ws}', [TemplateController::class, 'test']);
Route::post('/install', [InstallController::class, 'install']);
Route::post('/render', [TemplateController::class, 'getMyTemplates']);
Route::post('/export-pdf', [PDFController::class, 'exportPDF']);

Route::get('/workspaces/{id_ws}/projects/{id_pj}',[TemplateController::class, 'test']);

Route::controller(StorageController::class)->group(function () {
        Route::get('/storage/{id_ws}/{id_pj}/{any}', 'getStorage')->where('any', '.*');
        Route::post('/upload', 'uploadFile');
});


Route::controller(PageController::class)->group(function () {
        Route::get('/pages', 'getListPage');
        Route::get('/pages/detail', 'getPageDetail');
});

// Route::controller(TemplateController::class)->group(function () {
//         Route::get('/projects/datademo', 'insertDataDemo');
// });

Route::controller(DatabaseController::class)->group(function () {
        Route::get('/databases', 'getData');
        Route::get('/databases/detail', 'getDataById');
        Route::put('/databases/update', 'updated');
        Route::post('/databases/create', 'created');
        Route::delete('/databases/delete', 'deleted');
        Route::post('/databases/create-data-null', 'createDataNull');
        Route::post('/databases/import', 'imported');
        Route::post('/databases/export', 'exported');
        Route::get('/collections', 'getListCollections');
});

Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::group(['prefix' => 'workspaces'], function () {
                Route::group(['prefix' => '/{id_ws}/projects'], function () {
                        Route::group(['prefix' => '/{id_pj}/pages'], function () {

                                Route::controller(PageController::class)->group(function () {
                                        Route::group(['prefix' => '/{id_page}'], function () {
                                                Route::get('/members', 'getPageMembers');
                                                Route::post('/members', 'postInviteMembersToPage')->middleware('check:invite-project');
                                                Route::delete('/members', 'deleteMembersToPage'); //->middleware('check:delete-user-page');
                                        });
                                });
                        });
                });
        });

});

Route::controller(DomObjectController::class)->group(function () {
        Route::post('/objects/create-or-update', 'createOrUpdateObject');
        Route::delete('/objects/delete', 'deleted');
});

