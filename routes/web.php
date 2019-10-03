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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login','LoginController@index');
Route::post('/login-process','LoginController@LoginSession');

Route::group(['middleware' => ['SessionCheck','revalidate']],function()
{//start group
    Route::get('/logout','LoginController@LogoutSession');
    
    Route::get('/','AdminController@index');

    Route::get('/rejected','RejectedController@index');
    Route::get('/rejected/show','RejectedController@show');

    Route::get('/approve','ApproveController@index');
    Route::get('/approve/show','ApproveController@show');

    Route::get('/pendinglist','PendinglistController@index');
    Route::get('/pendinglist/show','PendinglistController@show');
    Route::post('/pendinglist/verification-process','PendinglistController@verification');

    Route::get('/customer','CustomerController@index');
    Route::get('/customer/show','CustomerController@show');
    Route::post('/customer/update','CustomerController@update');
    Route::get('/customer/delete/{id}','CustomerController@delete');
    Route::get('/customer/download','CustomerController@download');

    Route::get('/product-feedback','ProductFeedbackController@index');
    Route::get('/product-feedback/show','ProductFeedbackController@show');
    Route::get('/product-feedback/delete/{id}','ProductFeedbackController@delete');
    Route::get('/product-feedback/download','ProductFeedbackController@download');

    Route::get('/bug-report','BugReportController@index');
    Route::get('/bug-report/show','BugReportController@show');
    Route::get('/bug-report/delete/{id}','BugReportController@delete');
    Route::get('/bug-report/download','BugReportController@download');

    Route::get('/survey','SurveyController@index');
    Route::get('/survey/show','SurveyController@show');
    Route::get('/survey/delete/{id}','SurveyController@delete');
    Route::get('/survey/download','SurveyController@download');

    Route::get('/registered-contract','RegisteredContractController@index');
    Route::get('/registered-contract/show','RegisteredContractController@show');
    Route::get('/registered-contract/delete/{id}','RegisteredContractController@delete');
    Route::get('/registered-contract/download','RegisteredContractController@DownloadRegisteredContract');
    Route::get('/transaction-history/show','RegisteredContractController@TransactionHistory');
    Route::post('/transaction-history/download','RegisteredContractController@DownloadTransactionHistory');
    Route::get('/transaction-detail/show','RegisteredContractController@TransactionDetail');

    Route::get('/status-pengajuan-aplikasi','StatusPengajuanController@index');
    Route::get('/status-pengajuan-aplikasi/show','StatusPengajuanController@show');
    Route::get('/status-pengajuan-aplikasi/delete/{id}','StatusPengajuanController@delete');
    Route::get('/status-pengajuan-aplikasi/status-data','StatusPengajuanController@StatusData');
    Route::get('/status-pengajuan-aplikasi/download','StatusPengajuanController@DownloadStatusPengajuan');
    Route::post('/status-pengajuan-aplikasi/status-data/download','StatusPengajuanController@DownloadStatusData');

    Route::get('/push-notification','PushNotificationController@index');
    Route::get('/push-notification/show','PushNotificationController@show');
    Route::get('/push-notification/delete/{id}','PushNotificationController@delete');
    Route::post('/push-notification/update','PushNotificationController@update');

    Route::get('/holiday-gcm','HolidayGCMController@index');
    Route::post('/holiday-gcm/add','HolidayGCMController@add');
    Route::get('/holiday-gcm/show','HolidayGCMController@show');
    Route::post('/holiday-gcm/update','HolidayGCMController@update');
    Route::get('/holiday-gcm/delete/{id}','HolidayGCMController@delete');
    Route::get('/holiday-gcm/download','HolidayGCMController@download');

    Route::get('/master-kota','MasterKotaController@index');
    Route::get('/master-kota/show','MasterKotaController@show');
    Route::post('/master-kota/upload','MasterKotaController@upload');
    Route::post('/master-kota/add','MasterKotaController@add');
    Route::post('/master-kota/update','MasterKotaController@update');
    Route::get('/master-kota/delete/{id}','MasterKotaController@delete');

    Route::get('/promo','PromoController@index');
    Route::get('/promo/show','PromoController@show');
    Route::get('/promo/delete/{id}','PromoController@delete');
    Route::post('/promo/add','PromoController@create');
    Route::post('/promo/update','PromoController@update');
    Route::post('/promo/update-order','PromoController@UpdateOrder');

    Route::get('/master-content','MasterContentController@index');
    Route::get('/master-content/show','MasterContentController@show');
    Route::get('/master-content/delete/{id}','MasterContentController@delete');
    Route::post('/master-content/add','MasterContentController@create');
    Route::post('/master-content/update','MasterContentController@update');
    
    Route::get('/master-product-accone','MasterProductAccOneController@index');
    Route::get('/master-product-accone/show','MasterProductAccOneController@show');
    Route::get('/master-product-accone/deleteAll','MasterProductAccOneController@deleteAll');
    Route::post('/master-product-accone/upload','MasterProductAccOneController@upload');

    Route::get('/master-searching','MasterSearchingController@index');
    Route::get('/master-searching/show','MasterSearchingController@show');
    Route::post('/master-searching/add','MasterSearchingController@add');
    Route::post('/master-searching/update','MasterSearchingController@update');
    Route::get('/master-searching/delete/{id}','MasterSearchingController@delete');
    Route::post('/master-searching/upload','MasterSearchingController@upload');

    Route::get('/master-otr','MasterOtrController@index');
    Route::get('/master-otr/delete/{id}','MasterOtrController@delete');
    Route::get('/master-otr/download','MasterOtrController@download');
    Route::get('/master-otr/GetMstGcmType/{Brand}','MasterOtrController@GetMstGcmType');
    Route::get('/master-otr/GetMstGcmModel/{Type}','MasterOtrController@GetMstGcmModel');
    Route::post('/master-otr/add','MasterOtrController@add');
    Route::get('/master-otr/show','MasterOtrController@show');
    Route::post('/master-otr/update','MasterOtrController@update');

    Route::get('/history-pembayaran-asuransi-jiwa','HistoryPembayaranAsuransiJiwaController@index');
    Route::get('/history-pembayaran-asuransi-jiwa/show','HistoryPembayaranAsuransiJiwaController@show');
    Route::get('/history-pembayaran-asuransi-jiwa/delete/{id}','HistoryPembayaranAsuransiJiwaController@delete');

    Route::get('/data-tertanggung-utama','DataTertanggungUtamaController@index');
    Route::get('/data-tertanggung-utama/show','DataTertanggungUtamaController@show');
    Route::get('/data-tertanggung-utama/download','DataTertanggungUtamaController@download');

    Route::get('master-pernyataan','MasterPernyataanController@index');
    Route::get('master-pernyataan/show','MasterPernyataanController@show');
    Route::get('master-pernyataan/delete/{id}','MasterPernyataanController@delete');
    Route::post('master-pernyataan/add','MasterPernyataanController@add');
    Route::post('master-pernyataan/update','MasterPernyataanController@update');


});//end group route
