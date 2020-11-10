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
Route::get('/', function () {
  if(Auth::user()){
    return redirect('/posts');
  } else {
    return redirect('/login');
  }
});

Route::get('/home', function(){
  if(Auth::user()){
    return redirect('/posts');
  } else {
    return view('auth.login');
  }
});

// -----layout-----
Route::get('/layouts', 'LayoutController@index')->middleware('auth');

// -----notice-----
Route::resource('/notices', 'NoticeController');

// -----user-----
Route::resource('/users', 'UserController')->middleware('auth');
Route::resource('/users', 'UserController', ['only' => ['edit', 'update', 'destroy']])->middleware('can:admin');
Route::post('/users/delete/{id}', 'UserController@delete')->middleware('auth');
// Route::get('/users/{user}', 'UserController@show')->middleware('auth');

// -----post-----
Route::get('/posts/export_post', 'PostController@export_post')->name('export.post');
Route::resource('/posts', 'PostController')->middleware('auth');
Route::get('/posts/conclution', 'PostController@conclution')->middleware('auth');
// Route::resource('/posts', 'PostController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']])->middleware('can:admin');
Route::post('/posts/delete/{id}', 'PostController@delete')->middleware('auth');
// Route::get('/posts/{user}', 'PostController@show')->middleware('auth');

// -----conclusion-----
Route::get('/conclusions/export_conclution', 'ConclusionController@export_conclution')->name('export.conclution');
Route::get('/conclusions', 'ConclusionController@index')->middleware('auth');
Route::post('delete_post', 'ConclusionController@delete_post')->middleware('auth');

// -----task-----
Route::resource('/tasks', 'TaskController')->middleware('auth');
Route::resource('/tasks', 'TaskController', ['except' => ['index', 'show']])->middleware('can:admin');
Route::post('/tasks/delete/{id}', 'TaskController@delete')->middleware('auth');
// Route::get('/tasks/{user}', 'TaskController@show')->middleware('auth');

// -----matter-----
Route::resource('/matters', 'MatterController')->middleware('auth');
Route::resource('/matters', 'MatterController', ['except' => ['index', 'show']])->middleware('can:admin');
Route::post('/matters/delete/{id}', 'MatterController@delete')->middleware('auth');
// Route::get('/matters/{user}', 'MatterController@show')->middleware('auth');

// -----file-----
Route::resource('/files', 'FileController')->middleware('auth');
Route::resource('/files', 'FileController', ['except' => ['index']])->middleware('can:admin');
Route::post('/files/delete/{id}', 'FileController@delete')->middleware('auth');
// Route::get('/files/{user}', 'MatterController@show')->middleware('auth');

// -----content-----
Route::get('/contents', 'ContentController@index')->middleware('auth');

// -----progress-----
Route::get('/progresses/edit_ajax', 'ProgressController@edit_ajax')->middleware('auth');
Route::put('progresses', 'ProgressController@update_ajax')->middleware('auth');
// Route::post('/progresses/update_ajax', 'ProgressController@update_ajax')->middleware('auth');
Route::resource('/progresses', 'ProgressController')->middleware('auth');
Route::post('/progresses/delete/{id}', 'ProgressController@delete')->middleware('auth');
Route::post('delete_progress', 'ProgressController@delete_progress')->middleware('auth');



// Auth::routes();
// ↑下記のルーティングを使用しない場合はコメントアウトを解除する。
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => ['auth', 'can:admin']], function () {
  //ユーザー登録
  Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
  Route::post('register', 'Auth\RegisterController@register');
});

// Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
// Route::get('/home', 'PostController@index')->middleware('auth');
