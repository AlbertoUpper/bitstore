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

// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

Route::group(['prefix' => 'admin','middleware' => 'auth'], function(){

  	Route::get('/panel', 'AdminsController@index')->name('admin.index');

  	Route::group(['prefix' => 'categorias'], function(){
		Route::get('/', 'CategoryController@index')->name('categories.index');
		Route::post('store', 'CategoryController@store')->name('categories.store');
		Route::delete('destroy/{category}', 'CategoryController@destroy')->name('categories.destroy');

	});

	Route::group(['prefix' => 'proveedores'], function(){
		Route::get('/', 'SupplierController@index')->name('suppliers.index');
	});

	Route::group(['prefix' => 'productos'], function(){
		Route::get('/', 'ProductController@index')->name('products.index');
	});
 
});

Route::get('/', function () {
   return view('store.landing');
})->name('raiz');

Route::get('/destinos', 'Controller@index')->name('destinos.index');
Route::post('/destinos', 'Controller@search')->name('destinos.search');
Route::get('/landing', function(){
	return view('store.info.landing');
});
Route::get('/juego-descuento', function(){
	return view('store.info.juego');
})->name('juego');

Route::get('accesoVotacion', 'ValoracionController@falsoLogin')->name('falsoLogin');   
Route::get('registroVotacion', 'ValoracionController@falsoRegister')->name('falsoRegister');   
Route::post('registroVotacion', 'ValoracionController@falsoStore')->name('falsoStore');   
Route::post('votacion/', 'ValoracionController@index')->name('votacion');   
Route::post('votacion/sumar/{product}', 'ValoracionController@sumarLike');   
Route::post('votacion/restar/{product}', 'ValoracionController@restarLike');  

Route::group(['prefix' => '/tienda'], function(){

  	Route::get('/', 'StoreController@index')->name('store.index'); 

  	Route::post('/suscribirme', 'SubscribersController@store')->name('store.subscribe'); 
  	 
  	Route::post('/contacto', 'SubscribersController@contactus')->name('contactus');  

  	Route::get('/contactanos', 'StoreController@contact')->name('store.contact'); 

  	Route::get('/videoteca', 'StoreController@media')->name('store.media'); 
  	  
  	Route::get('/quienes_somos', 'StoreController@company')->name('store.company');   

  	Route::get('/productos', 'StoreController@products')->name('products.index'); 

  	Route::post('/productos/buscar', 'ProductController@search')->name('products.search');   
  	
  	Route::get('/productos/{prod}', 'ProductController@show')->name('product.detail');   

  	Route::post('/agregarCarrito/{prod}', 'OrderController@addCart')->name('addCart'); 

  	Route::post('/comprar/{prod}', 'OrderController@addCart')->name('buy');

  	Route::post('/guardar/{order}', 'OrderController@guardar')->name('saveCart');

  	Route::patch('/guardarDireccion', 'OrderController@saveAddress')->name('saveAddress');

  	Route::delete('/eliminardelCarrito/{prod}', 'OrderController@delCart')->name('delCart');

  	Route::get('/carrito', 'CartController@index')->name('cart'); 

  	Route::post('/proccesarCompra', 'CartController@proccesarCompra')->name('procBuy');

  	Route::get('/compras/historial', 'CartController@history')->name('history');

  	Route::post('descargar-detalle', 'CartController@pdf')->name('cart.pdf');     

  	
});

Auth::routes();
Route::get('/asder', function () {
   dd(public_path());
});

// Route::get('/home', 'HomeController@index')->name('home');
