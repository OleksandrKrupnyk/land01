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

/* standart routes
Route::get('/', function () {
    return view('welcome');

});*/

use App\Http\Controllers\Menu\AdminMenu;

Route::group(['middleware'=>'web'],function(){

	Route::match(['get','post'],'/',['uses'=>'IndexController@execute'])->name('homepage');
	Route::get('/page/{alias}',['uses'=>'PageController@execute'])->name('page');


	Route::auth();
});

//admin
Route::group(['prefix'=>'admin','middleware'=>'auth'], function(){

	//admin/
	Route::get('/',function(){
        if(view()->exists('admin.index'))
        {
	        $title = __('Admin Panel');
	        $menu = AdminMenu::get();
            return view('admin.index',compact('title','menu'));
        }

	})->name('admin');

	//admin/pages
	Route::group(['prefix'=>'pages'],function(){
		//admin/pages
		Route::get('/',['uses'=>'PagesController@execute'])->name('pages');
		//admin/pages/add
		Route::match(['get','post'],'/add',['uses'=>'PagesAddController@execute'])->name('pagesAdd');

		//admin/pages/edit/1
		Route::match(['get','post','delete'],'/edit/{page}',['uses'=>'PagesEditController@execute'])->name('pagesEdit');
	});

	//admin/porfolio
	Route::group(['prefix'=>'portfolios'],function(){
		//admin/porfolios/
		Route::get('/',['uses'=>'PortfolioController@index'])->name('portfolios');
		//admin/porfolios/add
		Route::match(['get','post'],'/add',['uses'=>'PortfolioController@add'])->name('portfolioAdd');
		//admin/porfolios/edit/1
		Route::match(['get','post','delete'],'/edit/{portfolio}',['uses'=>'PortfolioController@edit'])->name('portfoliosEdit');
	});


	//admin/services
	Route::group(['prefix'=>'services'],function(){
		//admin/services/
		Route::get('/',['uses'=>'ServiceController@execute'])->name('services');
		//admin/services/add
		Route::match(['get','post'],'/add',['uses'=>'ServiceAddController@execute'])->name('servicesAdd');
		//admin/services/edit/1
		Route::match(['get','post','delete'],'/edit/{portfolio}',['uses'=>'ServiceEditController@execute'])->name('servicesEdit');
	});

});








Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
