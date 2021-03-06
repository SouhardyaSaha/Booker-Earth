<?php

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
    return redirect('login');
});

Auth::routes();
Route::get('/user/activation/{token}', 'Auth\RegisterController@userActivation');


Route::get('/home', 'HomeController@index')->name('home');

// Book Requests
Route::group(['prefix' => 'book-requests'], function () {

    Route::get('/', 'BookRequestsController@index');
    Route::post('/', 'BookRequestsController@store');
    Route::get('my-book-requests', 'BookRequestsController@myBookRequests')->name('myBookRequests');
    Route::get('{id}/delete', 'BookRequestsController@destroy');
    Route::get('create', 'BookRequestsController@create');
    Route::get('{id}/message', 'BookRequestsController@getMessage')->name('bookRequestMessage');
    Route::post('{id}/message', 'BookRequestsController@postMessage')->name('bookRequestMessage.submit');

});


// Book Post
Route::group(['prefix' => 'book-posts'], function () {

    Route::get('{id}/delete', 'BookPostController@destroy');
    Route::get('{id}/message', 'BookPostController@getMessage');
    Route::post('{id}/message', 'BookPostController@postMessage');
    Route::get('my-book-posts', 'BookPostController@myBookPosts');
    Route::get('{id}/toggle/availability', 'BookPostController@availableBook');

});
Route::resource('book-posts', 'BookPostController');

// Book Post Comment
Route::post('comment', 'CommentController@store');

// Messages
Route::group(['prefix' => 'messages'], function () {
    Route::get('send', 'MessageController@send');
    Route::get('inbox', 'MessageController@inbox');
    Route::get('outbox', 'MessageController@outbox');
    Route::get('inbox/{message}', 'MessageController@show');
    Route::post('store', 'MessageController@store');
});
Route::get('api/users', 'ApiController@getUsers')->name('getUsers');


// Routes For Admin
Route::get('users', 'AdminController@getUsers');
Route::get('bannedusers', 'AdminController@getBannedUsers');
Route::post('ban/user', 'AdminController@banUser')->name('banUser');
//Creating User from admin Routes
Route::get('create/user', 'AdminController@createUser');
Route::post('create/user', 'AdminController@storeUser')->name('registerUserFromAdmin');

/// Auto Search Route For Books
Route::get('search-book', 'ApiController@BookSearchByApi');
