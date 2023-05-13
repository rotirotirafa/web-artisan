<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
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

// Ways to declare Routes with controller

Route::get('/home', [HomeController::class, 'home'])->name('home.index');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');

Route::get('/single', AboutController::class);

// Resource Controller - BEST PRACTICE


$posts = array(
    'title'=> 'Novo Post',
    'description'=> 'teste desc'
);

Route::get('/', function () {

    $response = array(
        "message" => "Up and Running!",
        "version" => "1.0.0",
        "application" => "Laravel Study"
    );

    return response()->json($response);
    
});
/* 
Route::get('/home', function () {
    return view('home.index', ['title'=>'teste']);
})->name('Home.Index');

Route::get('/contact', function (){
    return view('home.contact');
});

Route::post('/contact', function (){
    return 'Contact';
})->name('Contact POST');
*/
// Parameters /item/{item_id} REQUIRED

/*
Route::get('/posts/{id}', function ($id) {
    return 'Blog post ' . $id;
})->where([
    'id' => '[0-9]+'
])->name('Show Posts');
*/

// Parameters /item/{item_id?} OPTIONAL
Route::get('/recent-posts/{days_ago?}', function ($daysAgo = 10) {
    return 'Days Ago ' . $daysAgo;
});

// Retorno JSON
Route::get('/teste', function (){
    $response = array(
        "message"=> "Hello World"
    );


    return response()->json($response);
});

//Retorno com Cookies
Route::get('/fun/responses', function() use($posts) {
    return response($posts, 201)
    ->header('Content-Type', 'application/json')
    ->cookie('MY_COOKIE_NAME', 'Rafael Rotiroti', 360);
});

//Redirect
Route::get('/fun/redirect', function() {
    return redirect('/home');
});

//Redirect por rota nomeada
Route::get('/fun/named-route', function() {
    return redirect()->route('Home.Index');
});

//Return arquivos Download
Route::get('/fun/download', function(){
    return response()->download(public_path('/robots.txt'));
});

Route::prefix('/api')->name('API Routes')->group(function(){
    Route::get('/users', function(){
        return response()->json(array(
            "name"=>"Rafael"
        ));
    });
});

//Request Input (Query Parameters)
Route::get('exemplo', function() {
    dd(request()->all()); //DD = Dump and Die
    ///exemplo?teste=1 = array("teste"=>"1")
});


Route::resource('posts', PostsController::class);
/*
Apenas permite acesso aos métodos Index e Show
Route::resource('posts', PostsController::class)->only(['index', 'show']);
*/
/*
Permite acesso a todos os métodos exceto Delete
Route::resource('posts', PostsController::class)->except(['delete']);
*/
