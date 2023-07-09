<?php
 
use App\Http\Controllers\AnswerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\GroupAttachmentController;
use App\Http\Controllers\UserAttachmentController;
use App\Http\Middleware\CanViewGroup;
use App\Http\Middleware\CheckOwnGroup;
use App\Http\Middleware\Auth;

use App\Http\Controllers\PostController;
use App\Models\User;
/*   use Illuminate\Support\Facades\Auth;
 */  
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

 Route::get('login', [ UserController::class, 'login' ])->name('login');
Route::post('login', [ UserController::class, 'auth' ])->name('auth');

Route::get('signup', [ UserController::class, 'create' ])->name('signup');
Route::post('signup', [ UserController::class, 'store' ])->name('user.create');

Route::get('logout', [ UserController::class, 'logout' ])->name('logout')->middleware('auth');

Route::name('group.')->group(function() {

    Route::get('cours{id?}', [ GroupController::class, 'index' ])->name('index');

    Route::prefix('cours')->group(function() {

        Route::middleware('prof')->group(function () {
        
            Route::get('create', [ GroupController::class, 'create' ])->name('create');
            Route::post('create', [ GroupController::class, 'store' ])->name('store');
            
/*             Route::middleware(CheckOwnGroup::class)->group(function() {
 */                Route::get('delete/{id}', [ GroupController::class, 'delete' ])->name('delete');
                Route::get('edit/{id}', [ GroupController::class, 'edit' ])->name('edit');
                Route::post('edit/{id}', [ GroupController::class, 'update' ])->name('update');
                
                Route::get('{id}/answers', [ AnswerController::class, 'index' ])->name('answers');
                Route::get('{id}/members', [ MemberController::class, 'index' ])->name('members');
/*                 Route::get('{id}/members/delete/{member}', [ MemberController::class, 'delete' ])->name('members.delete');
 */        
                Route::get('{id}/answer/download/{answer}', [ AnswerController::class, 'download' ])->name('answer.download');

                Route::get('{id}/attachment/delete/{file}', [ GroupAttachmentController::class, 'delete' ])->name('attachment.delete');
/*             });
 */
        });


        Route::middleware('student')->group(function () {
            Route::get('join', [ MemberController::class, 'add' ])->name('member.add');
            Route::post('join', [ MemberController::class, 'store' ])->name('member.store');
            
            Route::post('{id}/response', [ AnswerController::class, 'store' ])->name('answer')->middleware(CanViewGroup::class);
            Route::get('{id}/response/undo', [ AnswerController::class, 'delete' ])->name('answer.delete');

        });


       // Route::middleware(CanViewGroup::class)->group(function() {
            Route::get('{id}', [ GroupController::class, 'show' ])->name('show');
            Route::get('{id}/attachment/download/{attachment}', [ GroupAttachmentController::class, 'download' ])->name('attachment.download');
      //  });

    });

})->middleware(Auth::class);



 Route::get('/', fn() => auth()->check() ? view('home.index') : view('home.welcome'))->name('home');
 
 Route::get('/boot', function () {
    return view('home.welcome');
});


Route::post('/home', 'App\Http\Controllers\HomeController@index')->name('dashbord');

 Route::post('logout', 'App\Http\Controllers\UserController@logout')->name('logout');
 
Route::get('password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');

// Routes pour la confirmation du mot de passe
Route::get('password/confirm', 'App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm')->name('password.confirm');
Route::post('password/confirm', 'App\Http\Controllers\Auth\ConfirmPasswordController@confirm');

// Routes pour la vérification de l'email
Route::get('email/verify', 'App\Http\Controllers\Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'App\Http\Controllers\Auth\VerificationController@verify')->name('verification.verify');
Route::post('email/resend', 'App\Http\Controllers\Auth\VerificationController@resend')->name('verification.resend');
/* Auth::routes(['except' => ['login','logout','register']]);
 */
 

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ExamController;

Route::get('/module/show',[ModuleController::class, 'index'])->name('module.show');
Route::get('/module/sh',[ModuleController::class, 'index'])->name('module.sh');

Route::get('/module/add',[ModuleController::class, 'add'])->name('module.add');
Route::post('/module/add',[ModuleController::class, 'store'])->name('module.store');
Route::post('/module/update',[ModuleController::class, 'delete'])->name('module.update');
Route::get('/module/affecter',[ModuleController::class, 'affecter'])->name('module.affecter');

Route::get('/exams/add-exam/{module}',[ExamController::class, 'index'])->name('exam.add');

Route::post('/exams/add',[ExamController::class, 'store'])->name('exam.store');
Route::get('/exams/show/{id?}',[ExamController::class, 'show'])->name('exam.show');
Route::get('/notes/show/',[ExamController::class, 'notes'])->name('exam.note');
Route::get('/exams/delete/{id_mod}',[ExamController::class, 'delete'])->name('exam.delete');


Route::get('{id}/module/delete/{member}', [ ModuleController::class, 'deleteMember' ])->name('members.delete');

use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\MessageController;

 Route::get('/discussions', [DiscussionController::class, 'index'])->name('discussions.index');
 Route::post('/discussion', [DiscussionController::class, 'store'])->name('discussions.store');
/* Route::post('/discussions', [DiscussionController::class, 'store'])->name('discussions.store');
 */Route::post('/discussions/messages', [MessageController::class, 'store'])->name('messages.store');
?>