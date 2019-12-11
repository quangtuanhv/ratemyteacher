<?php
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/redirect/{provider}', 'SocialController@redirectToProvider');
Route::get('/callback/{provider}', 'SocialController@callback');
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/active/{token}', 'UserController@active');

    Route::get('/user', 'UserController@index');
});
Route::get('/images/{path}', function (Illuminate\Http\Request $request, $path) {
    return app('glide')->getImageResponse($path, $request->all());
})->where('path', '.*');
// Admin

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

    Route::get('login', function () {
        if (Auth::check()) return redirect('admin');
        return view('admin.login');
    })->name('admin.login.get');

    Route::post('login', 'AuthController@login')->name('admin.login');

    Route::group(['middleware' => 'admin'], function () {
        Route::get('/', function () {
            return view('admin.index');
        })->name('admin');
        Route::group(['prefix' => 'users'], function () {
            Route::get('/', 'UserController@index')->name('user.list');
            Route::get('{id?}/delete', 'UserController@destroy')->name('user.delete');
            Route::get('{id?}/edit', 'UserController@edit')->name('user.edit');
            Route::post('{id?}/update', 'UserController@update')->name('user.update');
        });
        Route::group(['prefix' => 'teachers'], function () {
            Route::get('/', 'TeacherController@index')->name('teacher.list');
            Route::get('{id?}/delete', 'TeacherController@destroy')->name('teacher.delete');
            Route::get('{id?}/edit', 'TeacherController@edit')->name('teacher.edit');
            Route::post('{id?}/update', 'TeacherController@update')->name('teacher.update');
            Route::get('/create', 'TeacherController@create')->name('teacher.create');
        });
        Route::group(['prefix' => 'reviews'], function () {
            Route::get('/', 'ReviewController@index')->name('review.list');
            Route::get('{id?}/delete', 'ReviewController@destroy')->name('review.delete');
            Route::get('{id?}/edit', 'ReviewController@edit')->name('review.edit');
            Route::post('{id?}/update', 'ReviewController@update')->name('review.update');
        });
        Route::group(['prefix' => 'centers'], function () {
            Route::get('/', 'CenterController@index')->name('center.list');
            Route::get('{id?}/delete', 'CenterController@destroy')->name('center.delete');
            Route::get('{id?}/edit', 'CenterController@edit')->name('center.edit');
            Route::post('{id?}/update', 'CenterController@update')->name('center.update');
            Route::get('/create', 'CenterController@create')->name('center.create');
        });
    });
});
Route::get('/{vue_capture?}', function () {
    return view('app');
})->where('vue_capture', '(.*)')->name('app_main');

