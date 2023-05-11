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
    return 'HomePages';
});

Route::get('/contact', function (){
    return 'Contact';
});

Route::post('/contact', function (){
    return 'Contact';
})->name('Contact POST');

// Parameters /item/{item_id} REQUIRED
Route::get('/posts/{id}', function ($id) {
    return 'Blog post ' . $id;
})->where([
    'id' => '[0-9]+'
])->name('Show Posts');

// Parameters /item/{item_id?} OPTIONAL
Route::get('/recent-posts/{days_ago?}', function ($daysAgo = 10) {
    return 'Days Ago ' . $daysAgo;
});
