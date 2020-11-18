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

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/shop', function () {
    return view('shop');
});

use Illuminate\Support\Facades\DB;
Route::get('/test', function () {
    $response = DB::select('select * from customers where customerNumber = :number or customerNumber = :number2', ['number' => '103','number2' =>'181']);
    return $response;
});
//### normal page ####
Route::get('/','DataController@index');
Route::get('/welcome','DataController@promotion');
Route::get('/mnpd','DataController@mnproduct');
Route::get('/mncus','DataController@mncus');
Route::get('/mnod','DataController@mnorder');
Route::get('/mnem', function () {return view('manage-employee');});
Route::get('/order','DataController@order');
Route::get('/checkout','DataController@checkout');
Route::get('/shipping','DataController@shipping');
Route::get('/promotion','DataController@promotion');
Route::get('/payment','DataController@payment');

//### get function ###
Route::get('/getAddress/{code}','DataController@getAddress');
Route::get('/editproduct/{code}','DataController@editProduct');
Route::get('/editcus/{code}','DataController@editcus');
Route::get('/editstatus/{code}','DataController@editstatus');
Route::get('/detailstatus/{code}','DataController@detailstatus');
Route::get('/successOrder','DataController@successOrder');
Route::post('/login', 'DataController@login');
Route::get('/Subtotal', 'Datacontroller@Subtotal');
Route::get('/editAddress/{code}','DataController@editAddress');
Route::get('/Subtotal', 'Datacontroller@Subtotal');

//### Update Function ###
Route::post('/updateship/{code}','DataController@updateship');
Route::post('/updateProduct/{code}','DataController@updateProduct');
Route::post('/updateEm/{code}','DataController@updateEm');
Route::post('/NumberCart','DataController@NumberCart');
Route::post('/getPro','DataController@getPromotion');
Route::post('/UpdatePayment','DataController@UpdatePayment');
Route::post('/updateAddress/{code}/{addr}','DataController@updateAddress');
Route::post('/updatecus/{code}','DataController@updatecus');
Route::post('/updateship/{code}','DataController@updateship');
Route::post('/updateProduct/{code}','DataController@updateProduct');

//### Insert Function ###
Route::post('/insertToCart','DataController@insertTocart');
Route::post('/insertpromotion','DataController@insertpromotion');
Route::post('/reqSell','DataController@reqSell');
Route::post('/reqPro','DataController@reqPro');
Route::post('/getMyEmployee','DataController@getMyEmployee');
Route::post('/insertcus','DataController@insertcus');
Route::post('/insertEm','DataController@insertEm');
Route::post('/insertProduct','DataController@insertProduct');
Route::post('/addAddress/{code}','DataController@addAddress');

//### Delete Function ###
Route::delete('/deleteProduct/{code}','DataController@deleteProduct');
Route::delete('/deleteEm/{code}','DataController@deleteEm');
Route::delete('/deleteCart','DataController@deleteCart');
Route::delete('/deletecus/{code}','DataController@deletecus');
Route::delete('/deletepromotion','DataController@deletepromotion');
Route::post('/deleteAddress/{code}','DataController@deleteAddress');
