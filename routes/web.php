<?php
use Illuminate\Support\Facades\Route;

//Auth Management-------------------------------------------------------
Route::get('/register', function () {
    return view('userAuth.register');
});


Route::get('flightScrap', 'App\Http\Controllers\homeController@flightScrap');

//Route::get('/generatePDFStatement', function () {
//    return view('bankStatement.ucbStatementPDF');
//});

Route::get('/', 'App\Http\Controllers\homeController@home');
Route::get('all-login', 'App\Http\Controllers\authController@allLogin');
Route::get('customer-signup', 'App\Http\Controllers\authController@customerSignup');
Route::post('create-new-customer', 'App\Http\Controllers\authController@createNewCustomer');
Route::get('agent-signup', 'App\Http\Controllers\authController@agentSignup');
Route::post('createNewUser', 'App\Http\Controllers\authController@createNewUser');
Route::get('customer-profile', 'App\Http\Controllers\usersController@customerProfile');
Route::post('update-customer-profile', 'App\Http\Controllers\usersController@updateCustomerProfile');
Route::post('update-password', 'App\Http\Controllers\usersController@updatePassword');

Route::get('getAirportDetails', 'App\Http\Controllers\homeController@getAirportDetails');
Route::get('getAirportDetails1', 'App\Http\Controllers\homeController@getAirportDetails1');
Route::get('flight-search-result', 'App\Http\Controllers\homeController@flightSearchResult');
Route::get('flight-details', 'App\Http\Controllers\homeController@flightDetails');
Route::post('flight-booking', 'App\Http\Controllers\homeController@flightBooking');

Route::get('search-tour-package', 'App\Http\Controllers\homeController@searchTourPackage');
Route::get('search-visa', 'App\Http\Controllers\homeController@searchVisa');
Route::get('tour-package', 'App\Http\Controllers\homeController@tourPackage');
Route::get('tour-package/{slug}', 'App\Http\Controllers\homeController@searchTourPackageBySlug');
Route::get('visa', 'App\Http\Controllers\homeController@visa');
Route::get('visa/{slug}', 'App\Http\Controllers\homeController@searchVisaBySlug');
Route::get('work-permit', 'App\Http\Controllers\homeController@manpower');
Route::get('search-manpower', 'App\Http\Controllers\homeController@searchManpower');
Route::get('manpower/{slug}', 'App\Http\Controllers\homeController@searchManpowerBySlug');
Route::get('service', 'App\Http\Controllers\homeController@service');
Route::get('services/{slug}', 'App\Http\Controllers\homeController@searchServiceBySlug');
Route::get('blog/{slug}', 'App\Http\Controllers\homeController@searchBlogBySlug');
Route::get('about-us', 'App\Http\Controllers\homeController@aboutUs');
Route::post('contactUS', 'App\Http\Controllers\homeController@contactUS');
Route::post('subscribe', 'App\Http\Controllers\homeController@subscribe');
Route::get('contact-us', function () {return view('frontend.contact-us');});
Route::get('privacy-policy', 'App\Http\Controllers\homeController@privacyPolicy');
Route::get('terms-conditions', 'App\Http\Controllers\homeController@termsCondition');
Route::get('refund-policy', 'App\Http\Controllers\homeController@refundPolicy');
Route::get('cookie-policy', 'App\Http\Controllers\homeController@CookiePolicy');
//Route::get('importCsv', 'App\Http\Controllers\usersController@importCsv');
//Route::get('/', 'App\Http\Controllers\authController@loginPage');
Route::get('login', 'App\Http\Controllers\authController@loginPage');
Route::get('logout', 'App\Http\Controllers\authController@logout');
Route::post('verifyUsers', 'App\Http\Controllers\authController@verifyUsers');
Route::get('dashboard', 'App\Http\Controllers\authController@dashboard');
//----------------------------------------------------------
Route::middleware(['role'])->group(function () {
    //Dashboard----------------------------------------------------------
    Route::get('salesDataGraph', 'App\Http\Controllers\airTicketController@salesDataGraph');
    //General Invoice
    Route::get('g_invoice', 'App\Http\Controllers\accountsController@generalInvoice');
    Route::post('insertGInvoice', 'App\Http\Controllers\accountsController@insertGInvoice');
    Route::get('printGInvoice', 'App\Http\Controllers\accountsController@printGInvoice');
    Route::post('deleteGInvoice', 'App\Http\Controllers\accountsController@deleteGInvoice');
    //Contacts-------------------------------------------------------------
    Route::get('contacts', 'App\Http\Controllers\usersController@contacts');
    Route::post('createNewContacts', 'App\Http\Controllers\usersController@createNewContacts');
    Route::get('editContactsPage', 'App\Http\Controllers\usersController@editContactsPage');
    Route::post('updateContacts', 'App\Http\Controllers\usersController@updateContacts');
    //Air Ticket Management------------------------------------------------
    Route::get('newAirTicket', 'App\Http\Controllers\airTicketController@newAirTicket');
    Route::post('createNewAirTicket', 'App\Http\Controllers\airTicketController@createNewAirTicket');
    Route::get('editTicketPage', 'App\Http\Controllers\airTicketController@editTicketPage');
    Route::post('updateNewAirTicket', 'App\Http\Controllers\airTicketController@updateNewAirTicket');
    Route::post('deleteAirTicket', 'App\Http\Controllers\airTicketController@deleteAirTicket');
    Route::get('reissueAirTicket', 'App\Http\Controllers\airTicketController@reissueAirTicket');
    Route::get('searchPNRforReissue', 'App\Http\Controllers\airTicketController@searchPNRforReissue');
    Route::get('refundAirTicket', 'App\Http\Controllers\airTicketController@refundAirTicket');
    Route::get('searchPNRforRefund', 'App\Http\Controllers\airTicketController@searchPNRforRefund');
    Route::get('cancelAirTicket', 'App\Http\Controllers\airTicketController@cancelAirTicket');
    Route::get('searchPNRforCancel', 'App\Http\Controllers\airTicketController@searchPNRforCancel');
    Route::get('viewTicket', 'App\Http\Controllers\airTicketController@viewTicket');
    Route::get('editPaymentStatus', 'App\Http\Controllers\airTicketController@editPaymentStatus');
    Route::post('updateAirTicketPaymentStatus', 'App\Http\Controllers\airTicketController@updateAirTicketPaymentStatus');
    Route::get('filterAirTicket', 'App\Http\Controllers\airTicketController@filterAirTicket');
    Route::get('getAirportCode', 'App\Http\Controllers\airTicketController@getAirportCode');
    Route::post('generateAirInvoicePDF', 'App\Http\Controllers\airTicketController@generateAirInvoicePDF');
    Route::get('printAirTicket', 'App\Http\Controllers\airTicketController@printAirTicket');
    //----------------------------------------------------------

    //Visa Processing----------------------------------------------------------
    Route::get('newVisaProcess', 'App\Http\Controllers\visaController@newVisaProcess');
    Route::post('createNewVisa', 'App\Http\Controllers\visaController@createNewVisa');
    Route::get('viewVisa', 'App\Http\Controllers\visaController@viewVisa');
    Route::get('editVisaPaymentStatus', 'App\Http\Controllers\visaController@editVisaPaymentStatus');
    Route::post('updateVisaPaymentStatus', 'App\Http\Controllers\visaController@updateVisaPaymentStatus');
    Route::get('editVisaPage', 'App\Http\Controllers\visaController@editVisaPage');
    Route::post('editVisa', 'App\Http\Controllers\visaController@editVisa');
    Route::post('deleteVisa', 'App\Http\Controllers\visaController@deleteVisa');
    Route::get('printVisaInvoice', 'App\Http\Controllers\visaController@printVisaInvoice');
    //----------------------------------------------------------

    //Tour Package----------------------------------------------------------
    Route::get('newTourPackage', 'App\Http\Controllers\tourController@newTourPackage');
    Route::post('createNewTourPackage', 'App\Http\Controllers\tourController@createNewTourPackage');
    Route::get('editPackagePage', 'App\Http\Controllers\tourController@editPackagePage');
    Route::post('updateTourPackage', 'App\Http\Controllers\tourController@updateTourPackage');
    Route::post('deleteTourPackage', 'App\Http\Controllers\tourController@deleteTourPackage');
    Route::get('viewTourPackage', 'App\Http\Controllers\tourCo ntroller@viewTourPackage');
    //----------------------------------------------------------

    //Manpowe Package----------------------------------------------------------
    Route::get('newManPowerPackage', 'App\Http\Controllers\manpowerController@newManPowerPackage');
    //----------------------------------------------------------

    //User Management------------------------------------------------
    Route::get('users', 'App\Http\Controllers\usersController@users');
    Route::get('usersInfo', 'App\Http\Controllers\usersController@usersInfo');
    Route::get('isPassengerActive', 'App\Http\Controllers\usersController@isPassengerActive');
    Route::get('isPassengerInActive', 'App\Http\Controllers\usersController@isPassengerInActive');
    Route::post('createNewPassenger', 'App\Http\Controllers\usersController@createNewPassenger');
    Route::get('editPassengerPage', 'App\Http\Controllers\usersController@editPassengerPage');
    Route::post('editPassengerInfo', 'App\Http\Controllers\usersController@editPassengerInfo');
    Route::post('deletePassenger', 'App\Http\Controllers\usersController@deletePassenger');
    Route::get('searchPDetails', 'App\Http\Controllers\usersController@searchPDetails');
    //----------------------------------------------------------

    //Accounts Management------------------------------------------------
    Route::get('transactions', 'App\Http\Controllers\accountsController@transactions');
    Route::get('officeExpenses', 'App\Http\Controllers\accountsController@officeExpenses');
    Route::post('addOfficeExpense', 'App\Http\Controllers\accountsController@addOfficeExpense');
    Route::get('bankAccounts', 'App\Http\Controllers\accountsController@bankAccounts');
    Route::post('addBankAccounts', 'App\Http\Controllers\accountsController@addBankAccounts');
    Route::get('editBankAccount', 'App\Http\Controllers\accountsController@editBankAccount');
    Route::post('updateBankAccountsAmount', 'App\Http\Controllers\accountsController@updateBankAccountsAmount');
    Route::post('deleteBankAccount', 'App\Http\Controllers\accountsController@deleteBankAccount');
    Route::get('filterTransaction', 'App\Http\Controllers\accountsController@filterTransaction');
    Route::get('filterOfficeExpense', 'App\Http\Controllers\accountsController@filterOfficeExpense');
    //----------------------------------------------------------

    //Statement Management------------------------------------------------
    Route::get('ucbSolvency', 'App\Http\Controllers\statemntController@ucbSolvency');
    Route::post('generatePDF', 'App\Http\Controllers\statemntController@generatePDF');
    Route::get('ucbStatement', 'App\Http\Controllers\statemntController@ucbStatement');
    Route::post('generatePDFStatement', 'App\Http\Controllers\statemntController@generatePDFStatement');
    //----------------------------------------------------------

    //Sender Management------------------------------------------------
    Route::get('smsSender', 'App\Http\Controllers\senderController@smsSender');
    Route::post('sendSMS', 'App\Http\Controllers\senderController@sendSMS');
    Route::get('smsLog', 'App\Http\Controllers\senderController@smsLog');
    //----------------------------------------------------------

    //Settings Management------------------------------------------------
    Route::get('vendors', 'App\Http\Controllers\settingController@vendorSettings');
    Route::post('addNewVendor', 'App\Http\Controllers\settingController@addNewVendor');
    Route::get('editVendorPage', 'App\Http\Controllers\settingController@editVendorPage');
    Route::post('editVendor', 'App\Http\Controllers\settingController@editVendor');
    Route::post('deleteVendor', 'App\Http\Controllers\settingController@deleteVendor');

    Route::get('employees', 'App\Http\Controllers\settingController@employeeSettings');
    Route::post('addNewEmployee', 'App\Http\Controllers\settingController@addNewEmployee');
    Route::get('editEmployeePage', 'App\Http\Controllers\settingController@editEmployeePage');
    Route::post('editEmployee', 'App\Http\Controllers\settingController@editEmployee');
    Route::post('deleteEmployee', 'App\Http\Controllers\settingController@deleteEmployee');

    Route::get('companyInfo', 'App\Http\Controllers\settingController@companyInfo');
    Route::post('updateCompany', 'App\Http\Controllers\settingController@updateCompany');

    Route::get('airports', 'App\Http\Controllers\settingController@airports');
    Route::post('insertAirports', 'App\Http\Controllers\settingController@insertAirports');

    Route::get('airlines', 'App\Http\Controllers\settingController@airlines');
    Route::post('insertAirlines', 'App\Http\Controllers\settingController@insertAirlines');

    Route::get('airlinesLogo', 'App\Http\Controllers\settingController@airlinesLogoPage');
    Route::get('editAirlinesPage', 'App\Http\Controllers\settingController@editAirlinesPage');
    Route::post('editAirlines', 'App\Http\Controllers\settingController@editAirlines');
    Route::post('deleteAirlines', 'App\Http\Controllers\settingController@deleteAirlines');

    //Website Settings Management------------------------------------------------
    Route::get('b2cVisaManagement', 'App\Http\Controllers\websiteSettingController@b2cVisaManagement');
    Route::post('createNewB2CVisa', 'App\Http\Controllers\websiteSettingController@createNewB2CVisa');
    Route::get('editB2CVisaPage', 'App\Http\Controllers\websiteSettingController@editB2CVisaPage');
    Route::post('editNewB2CVisa', 'App\Http\Controllers\websiteSettingController@editNewB2CVisa');
    Route::post('deleteB2CVisaManagement', 'App\Http\Controllers\websiteSettingController@deleteB2CVisaManagement');
    Route::get('b2cVisaCountry', 'App\Http\Controllers\websiteSettingController@b2cVisaCountry');
    Route::post('addVisaCountry', 'App\Http\Controllers\websiteSettingController@addVisaCountry');
    Route::get('editVisaCountryName', 'App\Http\Controllers\websiteSettingController@editVisaCountryName');
    Route::post('editVisaPackCountry', 'App\Http\Controllers\websiteSettingController@editVisaPackCountry');
    Route::post('deleteVisaCountryName', 'App\Http\Controllers\websiteSettingController@deleteVisaCountryName');
    Route::get('b2cCompany', 'App\Http\Controllers\websiteSettingController@b2cCompany');
    Route::post('addCompanyInfo', 'App\Http\Controllers\websiteSettingController@addCompanyInfo');
    Route::get('tourPackCountry', 'App\Http\Controllers\websiteSettingController@tourPackCountry');
    Route::post('addTourPackCountry', 'App\Http\Controllers\websiteSettingController@addTourPackCountry');
    Route::get('editTourCountryName', 'App\Http\Controllers\websiteSettingController@editTourCountryName');
    Route::post('editTourPackCountry', 'App\Http\Controllers\websiteSettingController@editTourPackCountry');
    Route::post('deleteTourCountryName', 'App\Http\Controllers\websiteSettingController@deleteTourCountryName');
    Route::get('b2cTourPackage', 'App\Http\Controllers\websiteSettingController@b2cTourPackage');
    Route::post('addB2CTourPackage', 'App\Http\Controllers\websiteSettingController@addB2CTourPackage');
    Route::get('editB2CTourPackagePage', 'App\Http\Controllers\websiteSettingController@editB2CTourPackagePage');
    Route::post('editB2CTourPackage', 'App\Http\Controllers\websiteSettingController@editB2CTourPackage');
    Route::post('deleteB2CTourPackage', 'App\Http\Controllers\websiteSettingController@deleteB2CTourPackage');
    Route::get('blogManagement', 'App\Http\Controllers\websiteSettingController@blogManagement');
    Route::post('addB2CBlog', 'App\Http\Controllers\websiteSettingController@addB2CBlog');
    Route::get('editB2CBlogPage', 'App\Http\Controllers\websiteSettingController@editB2CBlogPage');
    Route::post('editB2CBlog', 'App\Http\Controllers\websiteSettingController@editB2CBlog');
    Route::post('deleteB2CBlog', 'App\Http\Controllers\websiteSettingController@deleteB2CBlog');
    Route::get('domainManage', 'App\Http\Controllers\websiteSettingController@domainManage');
    Route::post('addDomain', 'App\Http\Controllers\websiteSettingController@addDomain');
    Route::get('b2cManpowerCountry', 'App\Http\Controllers\websiteSettingController@b2cManpowerCountry');
    Route::post('addManpowerCountry', 'App\Http\Controllers\websiteSettingController@addManpowerCountry');
    Route::get('editManpowerCountryName', 'App\Http\Controllers\websiteSettingController@editManpowerCountryName');
    Route::post('editManpowerPackCountry', 'App\Http\Controllers\websiteSettingController@editManpowerPackCountry');
    Route::post('deleteManpowerCountryName', 'App\Http\Controllers\websiteSettingController@deleteManpowerCountryName');
    Route::get('b2cManpowerManagement', 'App\Http\Controllers\websiteSettingController@b2cManpowerManagement');
    Route::post('addB2CManpower', 'App\Http\Controllers\websiteSettingController@addB2CManpower');
    Route::get('editB2CManpowerPackagePage', 'App\Http\Controllers\websiteSettingController@editB2CManpowerPackagePage');
    Route::post('editB2CManpowerPackage', 'App\Http\Controllers\websiteSettingController@editB2CManpowerPackage');
    Route::post('deleteB2CManpowerPackage', 'App\Http\Controllers\websiteSettingController@deleteB2CManpowerPackage');
    Route::get('b2cServiceManagement', 'App\Http\Controllers\websiteSettingController@b2cServiceManagement');
    Route::post('addB2CServices', 'App\Http\Controllers\websiteSettingController@addB2CServices');
    Route::get('editB2CServicePage', 'App\Http\Controllers\websiteSettingController@editB2CServicePage');
    Route::post('editB2CService', 'App\Http\Controllers\websiteSettingController@editB2CService');
    Route::post('deleteB2CService', 'App\Http\Controllers\websiteSettingController@deleteB2CService');
});
//----------------------------------------------------------

