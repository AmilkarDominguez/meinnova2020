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

//Auth
Auth::routes();

///USERS///////

Route::get('/users', 'UserController@user')->name('user')->middleware('auth');
Route::resource('user', 'UserController')->except(['create','show']);
Route::get('listuser', 'UserController@list')->name('listuser')->middleware('auth');

//HOME
Route::get('/home', 'HomeController@index')->name('home');
/////CATALOGUES/////////
//Catalogs views
Route::get('/deposit', 'CatalogueController@deposit')->name('deposit')->middleware('auth');
Route::get('/industry', 'CatalogueController@industry')->name('industry')->middleware('auth');
Route::get('/line', 'CatalogueController@line')->name('line')->middleware('auth');
Route::get('/zone', 'CatalogueController@zone')->name('zone')->middleware('auth');

//Catalogs Controllers
Route::resource('catalogs', 'CatalogueController')->except(['create','show']);
Route::get('listcatalog', 'CatalogueController@list')->name('listcatalog')->middleware('auth');


/////CLIENTS/////////

Route::get('/clients', 'ClientController@client')->name('client')->middleware('auth');
Route::resource('client', 'ClientController')->except(['create','show']);
Route::get('listclient', 'ClientController@list')->name('listclient')->middleware('auth');

/////PRODUCTS/////////

Route::get('/products', 'ProductController@product')->name('product')->middleware('auth');
Route::resource('product', 'ProductController')->except(['create','show']);
Route::get('listproduct', 'ProductController@list')->name('listproduct')->middleware('auth');
/////PROVIDER/////////

Route::get('/providers', 'ProviderController@provider')->name('provider')->middleware('auth');
Route::resource('provider', 'ProviderController')->except(['create','show']);
Route::get('listprovider', 'ProviderController@list')->name('listprovider')->middleware('auth');

/////SELLER/////////
Route::get('/sellers', 'SellerController@seller')->name('seller')->middleware('auth');
Route::resource('seller','SellerController')->except(['create','show']);
Route::get('listseller', 'SellerController@list')->name('listseller')->middleware('auth');

/////COLLECTOR/////////

Route::get('/collectors', 'CollectorController@collector')->name('collector')->middleware('auth');
Route::resource('collector','CollectorController')->except(['create','show']);
Route::get('listcollector', 'CollectorController@list')->name('listcollector')->middleware('auth');

/////BATCH/////////
Route::get('/batches', 'BatchController@batch')->name('batch')->middleware('auth');
Route::resource('batch','BatchController')->except(['create']);

/////SHOP/////////
Route::get('/shops', 'ShopController@shop')->name('shop')->middleware('auth');
Route::resource('shop','ShopController')->except('create','edit','update','show','destroy');
Route::get('/dt_clients', 'ShopController@dt_clients')->name('dt_clients')->middleware('auth');

/////SALE/////////
Route::get('/sales', 'SaleController@sale')->name('sale')->middleware('auth');
Route::resource('sale','SaleController');

/////Detail/////////
Route::get('/details', 'DetailSaleProductController@detail')->name('detail')->middleware('auth');
Route::resource('detail','DetailSaleProductController');
Route::get('/details_of_sale', 'DetailSaleProductController@details_of_sale')->name('details_of_sale')->middleware('auth');


/////PAYMENT///////
Route::get('/payments', 'PaymentController@payment')->name('payment')->middleware('auth');
Route::resource('payment','PaymentController');

/////CHARGES///////
Route::get('/charges', 'ChargeController@charges')->name('charge')->middleware('auth');
Route::resource('charge','ChargeController');

////SALE COMPLETED//////

Route::get('/salecompleteds', 'SaleCompletedController@salecompleted')->name('salecompleted')->middleware('auth');
Route::resource('salecompleted','SaleCompletedController');

////REPORTS////////
/////DEBTS TO PAY//////
Route::get('/debtstopays', 'DebtsToPayController@debtstopay')->name('debtstopay')->middleware('auth');

/////ACCOUNTS RECEIVABLE//////
Route::get('/accountsreceivables', 'AccountsReceivableController@accountsReceivable')->name('accountsreceivable')->middleware('auth');

/////REPORTS//////////////

Route::get('/sellerreports','ReportController@sellerreport')->name('sellerreport')->middleware('auth');
Route::get('/reportlines','ReportController@reportline')->name('reportline')->middleware('auth');
Route::get('/reportcollectors','ReportController@reportcollector')->name('reportcollector')->middleware('auth');
Route::get('/reportaccounts','ReportController@reportaccountsreceivable')->name('reportaccount')->middleware('auth');
Route::get('/reportzones','ReportController@reportzone')->name('reportzone')->middleware('auth');


Route::get('/getsellers','ReportController@SelleReport')->name('getsellers')->middleware('auth');
Route::get('/getreportlines','ReportController@ReportLines')->name('getreportline')->middleware('auth');
Route::get('/getreportcollectors','ReportController@ReportCollectors')->name('getreportcollector')->middleware('auth');
Route::get('/getreportaccounts','ReportController@ReportAccounts')->name('getreportaccount')->middleware('auth');
Route::get('/getreporzones','ReportController@ReportSalesZones')->name('getreportzone')->middleware('auth');