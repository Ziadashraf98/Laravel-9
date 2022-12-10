<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\checkStatus;
use App\Mail\MailWelcomeUser;
use App\Mail\TestMail;
use App\Mail\WelcomeUser;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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

Route::get('/ok', function () {
    Storage::disk('public')->put('example.txt', 'welcome');
    return 'ok';
});

//========================================================================================================

// Route::controller(RoleController::class)->group(function()
// {
//     Route::get('/relationships' , 'index');
//     Route::get('/add_role_view' , 'add_role_view')->middleware(checkStatus::class);
//     Route::post('/add_role' , 'add_role');
// });

//=========================================================================================================

Route::middleware([checkStatus::class , 'auth'])->group(function()
{
    Route::get('/relationships' , [RoleController::class , 'index']);
    Route::get('/add_role_view' , [RoleController::class , 'add_role_view']);
    Route::get('/add_role' , [RoleController::class , 'add_role']);
});

//=============================================================================================================

Route::prefix('posts')->group(function () {
    Route::controller(PostController::class)->group(function() {
 
    Route::get('/' , 'index')->name('posts');
    Route::get('/create' ,'create')->name('create');
    Route::get('/edit/{id}' , 'edit')->name('edit');
    Route::get('/trashed_posts' , 'trashed_posts')->name('trashed_posts');
    Route::post('/store' , 'store')->name('store');
    Route::post('/update/{id}/{image}' , 'update')->name('update');
    Route::get('/delete/{id}' , 'delete')->name('delete');
    Route::get('/forceDelete/{id}' , 'forceDelete')->name('forceDelete');
    Route::get('/restorePost/{id}' , 'restorePost')->name('restorePost');
    Route::get('/delete_all' , 'delete_all')->name('delete_all');
    Route::get('/delete_truncate' , 'delete_truncate')->name('delete_truncate');
});
});


Route::group(['prefix'=>'ziad' , 'middleware'=>'auth'] , function () {
    Route::controller(UserController::class)->group(function() {

    Route::get('/' , 'index');
});
});

//==================================================================================================================

// Auth::routes(['verify'=>true]);
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');

//====================================================================================================================

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//======================================================================================================================

Route::get('/mark_all', function(){
	
    // Auth::user()->unreadNotifications->delete();
    Auth::user()->unreadNotifications->markAsRead();
	return back();

})->name('mark_all');

//====================================================================================================================

Route::get('/single_mark/{id}', function($id){
	
    $post = DB::table('notifications')->where('notifiable_id' , Auth::id())->where('data->post_id' , $id);
    $post->update(['read_at'=>now()]);
    return redirect()->route('edit' , $id);

})->name('single_mark');

//====================================================================================================================

Route::get('/test' , [TestController::class , 'test']);
Route::get('/users' , [TestController::class , 'users']);
Route::get('/mail' , [TestController::class , 'SendMail']);
