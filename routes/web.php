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
Route::group(['middleware' => 'revalidate'],function()
{
    Route::get('/login','LoginController@index');
    Route::post('/login-process','LoginController@LoginSession');
});

Route::group(['middleware' => ['SessionCheck','revalidate']],function()
{//start group
    Route::get('/logout','LoginController@LogoutSession');
    
    Route::get('/','AdminController@index');

    Route::get('/rejected','RejectedController@index');
    Route::get('/rejected/show','RejectedController@show');

    Route::get('/approve','ApproveController@index');
    Route::get('/approve/show','ApproveController@show');

    Route::get('/pending','PendingController@index');
    Route::get('/pending/show','PendingController@show');
    Route::post('/pending/verification-process','PendingController@verification');

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

    Route::get('/push-notification','PushNotificationController@index');
    Route::get('/push-notification/show','PushNotificationController@show');
    Route::get('/push-notification/delete/{id}','PushNotificationController@delete');
    Route::post('/push-notification/update','PushNotificationController@update');

    Route::get('/master-content','MasterContentController@index');
    Route::get('/master-content/show','MasterContentController@show');
    Route::get('/master-content/delete','MasterContentController@delete');
    Route::post('/master-content/add','MasterContentController@create');
    Route::post('/master-content/update','MasterContentController@update');
    Route::get('/master-content/get-by-content-type','MasterContentController@getByContentType');
    Route::post('/master-content/check-content-order','MasterContentController@checkContentOrder');
    Route::post('/master-content/check-content-title','MasterContentController@checkContentTitle');
    Route::post('/master-content/check-content-status','MasterContentController@checkContentStatus');

    Route::get('/landing-page','LandingPageController@index');
    Route::get('/landing-page/show','LandingPageController@show');
    Route::get('/landing-page/delete/{id}','LandingPageController@delete');
    Route::post('/landing-page/add','LandingPageController@create');
    Route::post('/landing-page/update','LandingPageController@update');
    Route::get('/landing-page/get-sub-category','LandingPageController@getSubCategory');
    Route::post('/landing-page/check-category','LandingPageController@checkCategory');
    
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
    Route::get('/master-otr/upload-page','MasterOtrUploadController@index')->name('master-otr/upload-page');
    Route::post('/master-otr/upload','MasterOtrUploadController@upload');
    Route::get('/master-otr/cancel','MasterOtrUploadController@cancel');
    Route::get('/master-otr/proceed','MasterOtrUploadController@proceed');
    // Route::get('/master-otr/OnChangeIsAlreadyUse/{Id}','MasterOtrUploadController@OnChangeIsAlreadyUse');

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

    Route::get('master-transaction-mobil','MasterTransactionMobilController@index');
    Route::get('master-transaction-mobil/show','MasterTransactionMobilController@show');
    Route::get('master-transaction-mobil/delete/{id}','MasterTransactionMobilController@delete');
    Route::get('master-transaction-mobil/download','MasterTransactionMobilController@download');

    Route::get('data-pemegang-polis','DataPemegangPolisController@index');
    Route::get('data-pemegang-polis-simulasi/show','DataPemegangPolisController@show');
    Route::get('data-pemegang-polis/download-simulasi','DataPemegangPolisController@downloadSimulasi');

    Route::get('master-product','MasterProductController@index');
    Route::get('master-product/show','MasterProductController@show');
    Route::post('master-product/update','MasterProductController@update');
    Route::get('master-product/sync-api-product','MasterProductController@SyncApiProduct');

    Route::get('user-mobile','UserMobileController@index');
    Route::get('user-mobile/show','UserMobileController@show');
    Route::post('user-mobile/update','UserMobileController@update');
    Route::get('user-mobile/download','UserMobileController@download');

    Route::get('user-cms','UserCMSController@index');
    Route::get('user-cms/show','UserCMSController@show');
    Route::post('user-cms/add','UserCMSController@add');
    Route::post('user-cms/update','UserCMSController@update');
    Route::get('user-cms/delete/{Id}&{UserDetail}','UserCMSController@delete');
    Route::get('user-cms/download','UserCMSController@download');

    Route::get('new-car', 'NewCarController@index');
    Route::get('new-car/show', 'NewCarController@show');
    Route::get('new-car/delete/{id}', 'NewCarController@delete');
    Route::get('new-car/download/{Status}&amp;{StartDate}&amp;{EndDate}', 'NewCarController@download');
    Route::post('new-car/get-by-condition', 'NewCarController@getByCondition');
    Route::post('new-car/update', 'NewCarController@update');

    Route::get('lease', 'LeaseController@index');
    Route::get('lease/show', 'LeaseController@show');
    Route::get('lease/delete/{id}', 'LeaseController@delete');
    Route::get('lease/download/{Status}&amp;{StartDate}&amp;{EndDate}', 'LeaseController@download');
    Route::post('lease/get-by-condition', 'LeaseController@getByCondition');
    Route::post('lease/update', 'LeaseController@update');

    Route::get('/acc-yes-migration','AccYesMigrationController@index');
    Route::get('/acc-yes-migration/delete/{Id}','AccYesMigrationController@delete');  
    Route::get('/acc-yes-migration/migrate','AccYesMigrationController@migrate');

    Route::get('/acc-yes-migration/upload-page','UploadAccYesMigrationController@index')->name('acc-yes-migration/upload-page');
    Route::get('/acc-yes-migration/cancel','UploadAccYesMigrationController@Cancel');
    Route::get('/acc-yes-migration/proceed','UploadAccYesMigrationController@proceed');
    Route::post('/acc-yes-migration/upload','UploadAccYesMigrationController@upload');

    Route::get('/role-management','RoleManagementController@index');
    Route::post('/role-management/add','RoleManagementController@add');
    Route::post('/role-management/update','RoleManagementController@update');
    Route::get('/role-management/show','RoleManagementController@show');
    Route::get('/role-management/delete/{Id}','RoleManagementController@delete');
    Route::get('/role-management/SyncRole','RoleManagementController@SyncRole');
    Route::get('/setting-role-management/{Id}&{RoleName}','SettingRoleManagementController@index');
    Route::get('/setting-role-management/OnChangeView/{Id}','SettingRoleManagementController@OnChangeView');
    Route::get('/setting-role-management/OnChangeCreate/{Id}','SettingRoleManagementController@OnChangeCreate');
    Route::get('/setting-role-management/OnChangeUpdate/{Id}','SettingRoleManagementController@OnChangeUpdate');
    Route::get('/setting-role-management/OnChangeDownload/{Id}','SettingRoleManagementController@OnChangeDownload');
    Route::get('/setting-role-management/OnChangeDelete/{Id}','SettingRoleManagementController@OnChangeDelete');

    Route::get('/trade-in','TradeInController@index');
    Route::post('/trade-in/get-by-condition','TradeInController@getByCondition');
    Route::get('/trade-in/delete/{Id}','TradeInController@delete');
    Route::get('/trade-in/show','TradeInController@show');
    Route::get('/trade-in/approve','TradeInController@approve');
    Route::get('/trade-in/download/{Status}/{StartDate}~{EndDate}','TradeInController@download');

    Route::get('/multipurpose','MultipurposeController@index');
    Route::post('/multipurpose/get-by-condition','MultipurposeController@getByCondition');
    Route::get('/multipurpose/show','MultipurposeController@show');
    Route::get('/multipurpose/delete/{Id}','MultipurposeController@delete');
    Route::get('/multipurpose/FollowUp','MultipurposeController@FollowUp');
    Route::get('/multipurpose/download/{Status}/{StartDate}~{EndDate}','MultipurposeController@download');

    Route::get('/master-gcm','MasterGcmController@index');
    Route::get('/master-gcm/get-by-condition','MasterGcmController@GetByCondition');
    Route::get('/master-gcm/delete','MasterGcmController@delete');
    Route::get('/master-gcm/show','MasterGcmController@show');
    Route::post('/master-gcm/add','MasterGcmController@add');
    Route::post('/master-gcm/update','MasterGcmController@update');
    Route::get('/master-gcm/download/{Condition}','MasterGcmController@download');

    Route::get('/master-gcm/upload-page','UploadMasterGcmUpload@index');
    Route::get('/master-gcm/cancel','UploadMasterGcmUpload@cancel');
    Route::get('/master-gcm/proceed','UploadMasterGcmUpload@proceed');
    Route::post('/master-gcm/upload','UploadMasterGcmUpload@upload');

    Route::get('/master-gcm/edit-gcm-access','EditGcmAccessController@index');
    Route::get('/master-gcm/edit-gcm-access/OnChangeAccWorld/{Id}&{Condition}&{AccWorld}','EditGcmAccessController@OnChangeAccWorld');

    Route::get('/acccash-apply/{Statusapply}','AccCashApplyController@index');
    Route::get('/acccash-apply/{Statusapply}/show','AccCashApplyController@show');
    Route::get('/acccash-apply/{Statusapply}/getbystatus','AccCashApplyController@getbystatus');
    Route::post('/acccash-apply/{Statusapply}/changestatus','AccCashApplyController@changestatus');
    Route::get('/acccash-apply/{Statusapply}/download','AccCashApplyController@download');

    Route::get('/acccash-apply-historysms','AccCashApplyHistorySMSController@index');
    Route::get('/acccash-apply-historysms/get-by-date','AccCashApplyHistorySMSController@getByDate');
    Route::get('/acccash-apply-historysms/download/{StartDate}/{EndDate}','AccCashApplyHistorySMSController@download');

    Route::get('/acccash-apply-plafon','AccCashApplyPlafonController@index');
    Route::get('/acccash-apply-plafon/broadcast','AccCashApplyPlafonController@broadcast');
    

    Route::get('/acccash-apply-detail/{GUID}&{Statusapply}','AccCashApplyDetailController@index');
    Route::post('/acccash-apply-detail/changestatus','AccCashApplyDetailController@changestatus');
    Route::get('/acccash-apply-detail/cetakPDF/{GUID}&{Statusapply}','AccCashApplyDetailController@cetakPDF');

    Route::get('/seamless-unit','SeamlessUnitController@index');
    Route::get('/seamless-unit/show','SeamlessUnitController@show');
    Route::get('/seamless-unit/{ID}/delete', array('before' => 'auth', 'as' => 'seamless-unit.delete', 'uses' => 'SeamlessUnitController@delete'));

    Route::get('/seamless-unit-update/{GUID}','SeamlessUnitUpdateController@index');
    Route::post('/seamless-unit-update/update','SeamlessUnitUpdateController@update');

    Route::get('/seamless-unit/upload-page','SeamlessUnitUploadController@index');
    Route::get('/seamless-unit/cancel','SeamlessUnitUploadController@cancel');
    Route::post('/seamless-unit/upload','SeamlessUnitUploadController@upload');
    Route::get('/seamless-unit/upload-pages/download/','SeamlessUnitUploadController@download');

    Route::get('/seamless-unit-detail/{Id}','SeamlessUnitDetailController@index');
    Route::get('/seamless-unit-detail/hitungsimulasi/{Id}&{Area}','SeamlessUnitDetailController@hitungsimulasi');
    Route::post('/seamless-unit-detail/delete-otr-selected','SeamlessUnitDetailController@deleteotrselected');
    Route::get('/seamless-unit-detail/deleteotrall/{Id}','SeamlessUnitDetailController@deleteotrall');
    Route::post('/seamless-unit-detail/delete-detail-selected','SeamlessUnitDetailController@deletedetailselected');
    Route::get('/seamless-unit-detail/deletedetailall/{Id}','SeamlessUnitDetailController@deletedetailall');
    Route::get('/seamless-unit-detail/deletecolorpict/{GUID}&{ID_UNIT}','SeamlessUnitDetailController@deletecolorpict');


    Route::get('/seamless-unit-detail-update/{ID_UNIT}&{GUID}','SeamlessUnitDetailUpdateController@index');
    Route::post('/seamless-unit-detail-update/update','SeamlessUnitDetailUpdateController@update');
    
    Route::get('/seamless-unit-picture/{GUID}&{ID_UNIT}','SeamlessUnitUploadPictureController@index');
    Route::post('/seamless-unit-picture/uploadpicture','SeamlessUnitUploadPictureController@uploadpicture');
    
    Route::get('/seamless-unit-detail/upload-page/{Id}','SeamlessUnitUploadDetailController@index');
    Route::get('/seamless-unit-detail/cancel/{Id}','SeamlessUnitUploadDetailController@cancel');
    Route::post('/seamless-unit-detail/upload/{Id}','SeamlessUnitUploadDetailController@upload');
    Route::get('/seamless-unit-detail/upload-pages/download/','SeamlessUnitUploadDetailController@download');

    Route::get('/seamless-unit-otr/upload-page/{Id}','SeamlessUnitUploadOtrController@index');
    Route::get('/seamless-unit-otr/cancel/{Id}','SeamlessUnitUploadOtrController@cancel');
    Route::post('/seamless-unit-otr/upload/{Id}','SeamlessUnitUploadOtrController@upload');
    Route::get('/seamless-unit-otr/upload-pages/download/','SeamlessUnitUploadOtrController@download');
    
    Route::get('/seamless-unit-color/upload-page/{Id}','SeamlessUnitUploadColorController@index');
    Route::get('/seamless-unit-color/cancel/{Id}','SeamlessUnitUploadColorController@cancel');
    Route::post('/seamless-unit-color/upload/{Id}','SeamlessUnitUploadColorController@upload');
    Route::get('/seamless-unit-color/download/','SeamlessUnitUploadColorController@download');
    Route::get('/seamless-unit-color/upload-pages/download/','SeamlessUnitUploadColorController@download');


    Route::get('/seamless-product','SeamlessProductController@index');
    Route::get('/seamless-product/show','SeamlessProductController@show');
    Route::get('/seamless-product/delete/{CD_PRODUCT}','SeamlessProductController@delete');
    

    Route::get('/seamless-product-detail/{Id}','SeamlessProductDetailController@index');
    Route::get('/seamless-product-detail/hitungsimulasi/{Id}&{Unitid}','SeamlessProductDetailController@hitungsimulasi');


    Route::get('/seamless-product-detail-update/{Id}','SeamlessProductDetailUpdateController@index');
    Route::post('/seamless-product-detail-update/update','SeamlessProductDetailUpdateController@update');

    Route::get('/seamless-product-picture/{CD_PRODUCT}','SeamlessProductUploadPictureController@index');
    Route::post('/seamless-product-picture/update','SeamlessProductUploadPictureController@update');

    Route::get('/seamless-banner','SeamlessBannerController@index');
    // Route::post('/seamless-banner/delete/{ID}','SeamlessBannerController@delete');
    Route::get('/seamless-banner/{ID}/delete', array('before' => 'auth', 'as' => 'seamless-banner.delete', 'uses' => 'SeamlessBannerController@delete'));

    Route::get('/seamless-banner-create','SeamlessBannerCreateController@index');
    Route::post('/seamless-banner-create/create','SeamlessBannerCreateController@create');

    Route::get('/seamless-banner-update/{Id}','SeamlessBannerUpdateController@index');
    Route::post('/seamless-banner-update/update','SeamlessBannerUpdateController@update');
 //   Route::post('/acccash-apply/changestatus/{Guid}','AccCashApplyController@changestatus');

    Route::get('/seamless-otrupload','SeamlessOtrUploadController@index');
    Route::get('/seamless-otrupload/cancel','SeamlessOtrUploadController@cancel');
    Route::post('/seamless-otrupload/upload','SeamlessOtrUploadController@upload');
    Route::get('/seamless-otrupload/download/','SeamlessOtrUploadController@download');

    Route::get('/seamless-otr-master','SeamlessOtrMasterController@index');
    Route::post('/seamless-otr-master/delete-otr-selected','SeamlessOtrmasterController@deleteotrselected');

    Route::get('/seamless-dataleads','SeamlessDataLeadsController@index');
    Route::get('/seamless-dataleads/get-by-bulantahun','SeamlessDataLeadsController@getByBulanTahun');
    Route::get('/seamless-dataleads/download/{bulan}/{tahun}','SeamlessDataLeadsController@download');

    Route::get('/seamless-dataleads-detail/{leadsid}','SeamlessDataLeadsDetailController@index');
    
    Route::get('/seamless-diskon','SeamlessDiskonController@index');
    Route::get('/seamless-diskon/delete/{GUID}','SeamlessDiskonController@delete');
    Route::get('/seamless-diskon-create','SeamlessDiskonCreateController@index');
    Route::post('/seamless-diskon-create/create','SeamlessDiskonCreateController@create');
    Route::get('/seamless-diskon-update/{GUID}','SeamlessDiskonUpdateController@index');
    Route::post('/seamless-diskon-update/update','SeamlessDiskonUpdateController@update');

    Route::get('/seamless-param','SeamlessParamController@index');
    Route::get('/seamless-param/delete/{CD_PRODUCT}','SeamlessParamController@delete');
    Route::get('/seamless-param-create','SeamlessParamCreateController@index');
    Route::post('/seamless-param-create/create','SeamlessParamCreateController@create');
    Route::get('/seamless-param-update/{CD_PRODUCT}','SeamlessParamUpdateController@index');
    Route::post('/seamless-param-update/update','SeamlessParamUpdateController@update');

    Route::get('/seamless-param','SeamlessParamController@index');
    Route::get('/seamless-param/delete/{CD_PRODUCT}','SeamlessParamController@delete');
    Route::get('/seamless-param-create/{CD_PRODUCT}','SeamlessParamCreateController@index');
    Route::post('/seamless-param-create/create','SeamlessParamCreateController@create');
    Route::get('/seamless-param-update/{CD_PRODUCT}','SeamlessParamUpdateController@index');
    Route::post('/seamless-param-update/update','SeamlessParamUpdateController@update');

    Route::get('/seamless-spbrand','SeamlessSpBrandController@index');
    Route::get('/seamless-spbrand/delete/{Id}','SeamlessSpBrandController@delete');
    Route::get('/seamless-spbrand-create','SeamlessSpBrandCreateController@index');
    Route::post('/seamless-spbrand-create/create','SeamlessSpBrandCreateController@create');
    Route::get('/seamless-spbrand-update/{Id}','SeamlessSpBrandUpdateController@index');
    Route::post('/seamless-spbrand-update/update','SeamlessSpBrandUpdateController@update');

    Route::get('/invalid-permission','InvalidPermissionController@index');
});//end group route
