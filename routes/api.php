<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Base\Auth\AuthController;
use App\Http\Controllers\Base\Project\ProjectController;
use App\Http\Controllers\Base\Common\CommonController;
use App\Http\Controllers\Base\Profile\ProfileController;
use App\Http\Controllers\Base\Workspace\WorkspaceController;
use App\Http\Controllers\Base\Database\DatabaseController;
use App\Http\Controllers\Base\File\Filecontroller;
use App\Http\Controllers\Base\Layout\LayoutController;
use App\Http\Controllers\Base\Template\TemplateController;
use App\Http\Controllers\Base\Page\PageController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function () {
    Route::post('login',  'login');
    Route::post('register', 'register');
    Route::get('verify/{userId}/{verifyCode}','verifyEmail');
    Route::post('reset-password', 'resetPassword');

    // NOTE: Example for FE work ( DEMO )
    Route::get('languagefile','getLanguagefile');
    // End NOTE
    
});


Route::group(['prefix' => 'common'], function () {
    Route::get('/configs', [CommonController::class, 'getConfigs']);
});

Route::group(['prefix' => 'auth', 'middleware' => 'auth:sanctum'], function () {
    Route::post('/logout',[AuthController::class, 'logout']);
    Route::post('/upload', [Filecontroller::class, 'uploadFile']);

    Route::group(['prefix' => 'profile'], function () {

        Route::controller(ProfileController::class)->group(function () {

            // new File Excel
            Route::get('/', 'getProfile');
            Route::put('/', 'updateProfileInfo');
            // end

            Route::post('/change-password', 'changePassword');
            
            Route::post('/update-facturation','updateFacturation');
            // Route::post('/get-facturation','getFacturation'); // working....


            Route::post('/update-avatar',  'updateAvatar');

        });
    });


    Route::group(['prefix' => 'workspaces'], function () {
        Route::controller(WorkspaceController::class)->group(function () {

            Route::get('/', 'getListWorkspace');
            Route::post('/', 'createWorkspace');
            # Invite member to workspace
            Route::post('/{id_ws}/members', 'inviteMembersToWorkspace');

            Route::get('/{id_ws}/templates', 'listTemplateWorkspace');

            # Delete member out of workspace
            Route::delete('/{id_ws}/members/{id_user}', 'removeMemberWorkspace')->middleware('check:delete-member-workspace');

            Route::get('/{id_ws}/roles','listRoleWorkspace');

            Route::group(['prefix' => '/{id_ws}'], function () {
                
                // check: permistion
                Route::delete('/', 'destroyWorkspace');//->middleware('check:delete-workspace');
                Route::put('/', 'editWorkspace');//->middleware('check:edit-workspace'); //->middleware('check:edit-workspace|owner-workspace'); Pedding.... dev Quan
                //end permistion

                Route::group(['prefix' => '/members'], function () {

                    Route::get('/', 'getWorkspaceUsers');

                });

            });

        });

        Route::controller(ProjectController::class)->group(function () {
            
            Route::group(['prefix' => '/{id_ws}/projects'], function () {
               
                Route::get('/','getWorkspaceProjects');
                Route::post('/', 'createProject');
                Route::get('/{id_pj}/pages', 'getListPage');
                Route::get('/{id_pj}/pages/{id_page}', 'getPageDetail');


                // Route::group(['prefix' => '/{id_pj}/pages'], function () {

                //     Route::controller(PageController::class)->group(function () {

                //             Route::group(['prefix' => '/{id_page}'], function () {
                //                     Route::get('/members', 'getPageMembers');
                //                     Route::post('/members', 'postInviteMembersToPage')->middleware('check:invite-project');
                //                     Route::delete('/members', 'deleteMembersToPage'); //->middleware('check:delete-user-page');
                //             }); 
                //     });
                // });

            });
        
        });
        
        // Route::controller(PageController::class)->group(function () {
        //     Route::group(['prefix' => '/{id_ws}/projects/{id_pj}'], function () {
        //         Route::get('/pages', 'getListPage');
        //         Route::get('/pages/{id_page}', 'getPageDetail');
        //     });
        
        // });

        Route::controller(DatabaseController::class)->group(function () {
            Route::group(['prefix' => '/{id_ws}/projects/{id_pj}/databases'], function () { 
                Route::post('/import', 'imported');
                Route::get('/', 'getData');
                Route::post('/', 'created');
                Route::get('/{id}', 'getDataById');
                Route::put('/{id}', 'updated');
                Route::delete('/', 'deleted');
                Route::post('/create-data-null', 'createDataNull');
            });
        });
    });

    Route::group(['prefix' => 'project'], function () {
        Route::controller(ProjectController::class)->group(function () {

            //has paginate : ?page=2
           
            Route::get('/workspace-detail', 'getProjectWorkspaceDetail');
            Route::get('/detail', 'getProjectsDetail');
            //end paginate

            // check roles & per working
            Route::post('/edit', 'editProject');
            Route::post('/destroy', 'destroyProject');
            //end roles & per
        });
    });

    Route::group(['prefix' => 'layout'], function () {
        Route::controller(LayoutController::class)->group(function () {
            Route::get('/setup', 'setUpLayout');
        });
    });

    
    
});



// Route::get('/migrate', function(){
//     \Artisan::call('migrate:refresh --seed');
// });
// Route::get('/migrate_fresh', function(){
//     \Artisan::call('php artisan migrate:fresh');
// });
// Route::get('/clear', function(){
//     \Artisan::call('optimize:clear ');
// });


// Route::group(['prefix' => 'templates'], function () {
//     Route::post('/test/{id_ws}', [TemplateController::class, 'test']);
//     Route::post('/install', [TemplateController::class, 'installMyTemplates']);
//     Route::post('/render', [TemplateController::class, 'getMyTemplates']);


//     Route::controller(PageController::class)->group(function () {
//             Route::get('/pages', 'getListPage');
//             Route::get('/pages/detail', 'getPageDetail');
//     });
// });
require __DIR__.'/admin.php';
