<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
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

Route::group(['middleware' => ['auth', 'checkRole:1'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('users', 'AdminController@users')->name('users');
    Route::get('chats', 'AdminController@chats')->name('chats');
    Route::get('selfhelp', 'AdminController@selfhelp')->name('selfhelp');
    Route::get('profile', 'AdminController@profile')->name('profile');
    Route::get('profile/edit', 'AdminController@editprofile')->name('editprofile');
    Route::get('profile/editpassword', 'AdminController@editpassword')->name('editpassword');
    Route::resource('user', 'UserController');
    Route::resource('help', 'HelpController');
    Route::resource('chat', 'ChatController');
});

Route::group(['middleware' => ['auth', 'checkRole:2'], 'as' => 'counsellor.', 'prefix' => 'counsellor'], function () {
    Route::get('/', 'CounsellorController@index')->name('index');
    Route::get('selfhelp', 'CounsellorController@selfhelp')->name('selfhelp');
    Route::get('chats', 'CounsellorController@chats')->name('chats');
    Route::get('newchat/{uid}', 'CounsellorController@newchat')->name('newchat');
    Route::get('chat/{cid}', 'CounsellorController@openchat')->name('openchat');
    Route::post('addmessage/{cid}', 'CounsellorController@addmessage')->name('addMessage');
    Route::resource('help', 'HelpController');
    Route::get('profile', 'CounsellorController@profile')->name('profile');
    Route::get('profile/edit', 'CounsellorController@editprofile')->name('editprofile');
    Route::get('profile/editpassword', 'CounsellorController@editpassword')->name('editpassword');
});

Route::group(['middleware' => ['auth', 'checkRole:3'], 'as' => 'student.', 'prefix' => 'student'], function () {
    Route::get('/', 'StudentController@index')->name('index');
    Route::get('selfhelp', 'StudentController@selfhelp')->name('selfhelp');
    Route::get('chats', 'StudentController@chats')->name('chats');
    Route::get('newchat/{uid}', 'StudentController@newchat')->name('newchat');
    Route::get('chat/{cid}', 'StudentController@openchat')->name('openchat');
    Route::post('addmessage/{cid}', 'StudentController@addmessage')->name('addMessage');
    Route::get('profile', 'StudentController@profile')->name('profile');
    Route::get('profile/edit', 'StudentController@editprofile')->name('editprofile');
    Route::get('profile/editpassword', 'StudentController@editpassword')->name('editpassword');
});

Route::get('/home', function(){
    if(auth()->user()->userRole == 1){
        return redirect()->route('admin.index');
    }
    else if (auth()->user()->userRole == 2){
        return redirect()->route('counsellor.index');
    }
    else if (auth()->user()->userRole == 3){
        return redirect()->route('student.index');
    }
    else {
        return redirect()->route('login');
    }
});

Route::get('/', function(){
    if(auth()->user()->userRole == 1){
        return redirect()->route('admin.index');
    }
    else if (auth()->user()->userRole == 2){
        return redirect()->route('counsellor.index');
    }
    else if (auth()->user()->userRole == 3){
        return redirect()->route('student.index');
    }
    else {
        return redirect()->route('login');
    }
})->middleware('auth');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
