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
    return view('welcome');
});

Auth::routes();

Route::get('home', 'HomeController@index');

Route::post('pages', 'HomeController@addpages');

Route::get('pages/{page}/edit', 'HomeController@editpages');

Route::put('pages/{page}/edit', 'HomeController@updatepages');

Route::get('themes', 'HomeController@themes');

Route::post('themes', 'HomeController@addthemes');

Route::get('themes/{theme}/edit', 'HomeController@editthemes');

Route::put('themes/{theme}/edit', 'HomeController@updatethemes');

Route::get('links', 'HomeController@links');

Route::post('links', 'HomeController@addlinks');

Route::get('links/{link}/edit', 'HomeController@editlinks');

Route::put('links/{link}/edit', 'HomeController@updatelinks');

Route::get('{slug}', function($slug){
	$page = App\Page::whereSlug(strtolower($slug))->firstorFail();
    
    $code = strtoupper($page->slug);

    $keywords = explode(PHP_EOL, $page->link->keywords);


    $keyword = str_replace("%keyword%", str_replace(" ", "+", $keywords[$page->link->counter]), $page->link->link);

    $link = str_replace("%slug%", strtoupper($page->slug), $keyword);

    if ($page->link->counter < count($keywords) - 1) {
        $page->link->counter++;
    } else {
        $page->link->counter = 0;
    }

    $page->link->save();

    return eval("?>" . $page->theme->html . "<?");
});

