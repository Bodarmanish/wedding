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
// use App\Mail\VenueBook;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/VenueBookMail',function() {
// 	return new VenueBook();
// });
// ADMIN LOGIN ROUTES
Route::get('admin', 'Admin\AdminLoginController@index');
Route::post('admin_login', 'Admin\AdminLoginController@login');
Route::get('admin_logout', 'Admin\AdminLoginController@logout')->name('admin.logout');


// PROFILE ROUTES
Route::get('admin/edit_profile', 'Admin\AdminController@edit_profile')->name('admin.edit.prifle');
Route::post('admin/update_profile', 'Admin\AdminController@update_profile')->name('admin.update.prifle');
Route::get('admin/change_password', 'Admin\AdminController@change_password')->name('admin.change.password');
Route::post('admin/update_password', 'Admin\AdminController@update_password')->name('admin.update.password');


// ROLE ROUTES
Route::get('/admin/roles', 'Admin\RoleController@index')->name('admin.list.roles');
Route::get('/admin/role/create', 'Admin\RoleController@create')->name('admin.role.add');
Route::post('/admin/role/save', 'Admin\RoleController@save')->name('admin.role.save');
Route::get('/admin/role/edit/{id}', 'Admin\RoleController@edit')->name('admin.role.edit');
Route::post('/admin/role/update', 'Admin\RoleController@update')->name('admin.role.update');
Route::post('/admin/role/delete', 'Admin\RoleController@delete')->name('admin.role.delete');

//ROLE PERMISSION ROUTES
Route::get('/admin/role/permission/{id}', 'Admin\RoleController@permission')->name('admin.role.permission');
Route::post('/admin/role/permission/store', 'Admin\RoleController@permission_store')->name('admin.permision.store');

// USER RELATED ROUTES
Route::get('admin/dashboard', 'Admin\AdminController@index')->name('admin.dashboard');
Route::get('admin/users', 'Admin\AdminController@list_users')->name('admin.list.users');
Route::get('admin/user/edit/{id}', 'Admin\AdminController@edit_user')->name('admin.edit.users');
Route::post('admin/user/update', 'Admin\AdminController@update_user')->name('admin.update.users');
Route::post('admin/user/delete', 'Admin\AdminController@delete_user')->name('admin.delete.users');
Route::get('admin/user/create', 'Admin\AdminController@add_users')->name('admin.add.users');
Route::post('admin/user/save', 'Admin\AdminController@save_user')->name('admin.save.users');

// VENUE ROUTES
Route::get('admin/venue', 'Admin\Venue\VenueController@index')->name('admin.list.venue');
Route::get('admin/venue/create', 'Admin\Venue\VenueController@add_venue')->name('admin.create.venue');
Route::post('admin/venue/save', 'Admin\Venue\VenueController@save_venue')->name('admin.save.venue');
Route::get('admin/venue/edit/{id}', 'Admin\Venue\VenueController@edit_venue')->name('admin.edit.venue');
Route::post('admin/venue/update', 'Admin\Venue\VenueController@update_venue')->name('admin.update.venue');
Route::post('admin/venue/delete', 'Admin\Venue\VenueController@delete_venue')->name('admin.delete.venue');

// TERMS CONDITIONS ROUTES
Route::get('admin/venue/add_terms_conditions/{id}', 'Admin\Venue\VenueController@add_tremsConditions')->name('admin.add.termsconditions');
Route::post('admin/venue/save_terms_conditions/{id}', 'Admin\Venue\VenueController@save_termsConditions')->name('admin.save.termsconditions');
Route::post('admin/venue/delete_terms_conditions', 'Admin\Venue\VenueController@delete_termsConditions')->name('admin.delete.termsconditions');


// CANCELLATION POLICY ROUTES
Route::get('admin/venue/add_privacy_policy/{id}', 'Admin\Venue\VenueController@add_policy')->name('admin.add.policy');
Route::post('admin/venue/sav_privacy_policy/{id}', 'Admin\Venue\VenueController@save_policy')->name('admin.save.policy');
Route::post('admin/venue/delete_policy/{id}', 'Admin\Venue\VenueController@delete_policy')->name('admin.delete.policy');


// DOCUMENT ROUTES
Route::get('admin/venue/add_document/{id}', 'Admin\Venue\VenueController@add_document')->name('admin.add.document');
Route::post('admin/venue/sav_document', 'Admin\Venue\VenueController@save_document')->name('admin.save.document');

// VENUE MEDIA ROUTES
Route::get('admin/show/media/{id}', 'Admin\Venue\VenueController@show_media')->name('admin.show.media');
Route::match(['get', 'post'], 'admin/create/media/{id}','Admin\Venue\VenueController@add_media')->name('admin.create.media');
Route::match(['get', 'post'], '/editmedia/{id}/{medid}','Admin\Venue\VenueController@editmedia');
Route::get('media/delete/{id}','Admin\Venue\VenueController@mediadelete');


// INSTRUCTION ROUTES
Route::get('admin/venue/add_instruction/{id}', 'Admin\Venue\VenueController@add_instruction')->name('admin.add.instructions');
Route::post('admin/venue/sav_instruction/{id}', 'Admin\Venue\VenueController@save_instruction')->name('admin.save.instructions');
Route::post('admin/venue/delete_instruction', 'Admin\Venue\VenueController@delete_instruction')->name('admin.delete.instructions');

// ---- MASTERS ----
// EVENT TYPE
Route::get('admin/master/lead/event-type', 'Admin\Master\EventTypeController@index')->name('admin.master.event-type');
Route::get('admin/master/lead/event-type/create', 'Admin\Master\EventTypeController@create')->name('admin.master.event-type.create');
Route::post('admin/master/lead/event-type/store', 'Admin\Master\EventTypeController@store')->name('admin.master.event-type.store');
Route::get('admin/master/lead/event-type/edit/{id}', 'Admin\Master\EventTypeController@edit')->name('admin.master.event-type.edit');
Route::post('admin/master/lead/event-type/update', 'Admin\Master\EventTypeController@update')->name('admin.master.event-type.update');
Route::post('admin/master/lead/event-type/delete', 'Admin\Master\EventTypeController@delete')->name('admin.master.event-type.delete');


// PRESENTATION STATUS
Route::get('admin/master/lead/presentation-status', 'Admin\Master\PresentationStatusController@index')->name('admin.master.presentation-status');
Route::get('admin/master/lead/presentation-status/create', 'Admin\Master\PresentationStatusController@create')->name('admin.master.presentation-status.create');
Route::post('admin/master/lead/presentation-status/store', 'Admin\Master\PresentationStatusController@store')->name('admin.master.presentation-status.store');
Route::get('admin/master/lead/presentation-status/edit/{id}', 'Admin\Master\PresentationStatusController@edit')->name('admin.master.presentation-status.edit');
Route::post('admin/master/lead/presentation-status/update', 'Admin\Master\PresentationStatusController@update')->name('admin.master.presentation-status.update');
Route::post('admin/master/lead/presentation-status/delete', 'Admin\Master\PresentationStatusController@delete')->name('admin.master.presentation-status.delete');

// FACILITY CHARGES
Route::get('admin/master/venue-settings/falicility-charges', 'Admin\Master\VenueSettingController@facility_charges')->name('admin.masters.venue-settings.facility-charges');
Route::get('admin/master/venue-settings/falicility-charges/create', 'Admin\Master\VenueSettingController@create_facility_charges')->name('admin.masters.venue-settings.facility-charges.create');
Route::post('admin/master/venue-settings/falicility-charges/store', 'Admin\Master\VenueSettingController@store_facility_charges')->name('admin.masters.venue-settings.facility-charges.store');
Route::get('/admin/master/venue-settings/falicility-charges/edit/{id}', 'Admin\Master\VenueSettingController@edit_facility_charges')->name('admin.masters.venue-settings.facility-charges.edit');
Route::post('admin/master/venue-settings/falicility-charges/update', 'Admin\Master\VenueSettingController@update_facility_charges')->name('admin.masters.venue-settings.facility-charges.update');
Route::post('admin/master/venue-settings/falicility-charges/delete', 'Admin\Master\VenueSettingController@delete_facility_charges')->name('admin.masters.venue-settings.facility-charges.delete');


// BSM & CSM START
//BSM
Route::get('admin/bsm', 'Admin\BSM_CSM\BsmController@index')->name('admin.bsm');
Route::get('admin/bsm/create', 'Admin\BSM_CSM\BsmController@create')->name('admin.bsm.create');
Route::post('admin/bsm/store', 'Admin\BSM_CSM\BsmController@store')->name('admin.bsm.store');
Route::get('admin/bsm/edit/{id}', 'Admin\BSM_CSM\BsmController@edit')->name('admin.bsm.edit');
Route::post('admin/bsm/update', 'Admin\BSM_CSM\BsmController@update')->name('admin.bsm.update');
Route::post('admin/bsm/delete', 'Admin\BSM_CSM\BsmController@delete')->name('admin.bsm.delete');


//CSM
Route::get('admin/csm', 'Admin\BSM_CSM\CsmController@index')->name('admin.csm');
Route::get('admin/csm/create', 'Admin\BSM_CSM\CsmController@create')->name('admin.csm.create');
Route::post('admin/csm/store', 'Admin\BSM_CSM\CsmController@store')->name('admin.csm.store');
Route::get('admin/csm/edit/{id}', 'Admin\BSM_CSM\CsmController@edit')->name('admin.csm.edit');
Route::post('admin/csm/update', 'Admin\BSM_CSM\CsmController@update')->name('admin.csm.update');
Route::post('admin/csm/delete', 'Admin\BSM_CSM\CsmController@delete')->name('admin.csm.delete');


// BSM & CSM END
// 
// 
// VENUE TYPE & CHARGES
Route::get('admin/master/venue-settings/venue-type-and-charges', 'Admin\Master\VenueSettingController@venue_type_and_charges')->name('admin.masters.venue-settings.venue-type-and-charges');
Route::get('admin/master/venue-settings/venue-type-and-charges/create', 'Admin\Master\VenueSettingController@create_venue_type_and_charges')->name('admin.masters.venue-settings.venue-type-and-charges.create');
Route::post('admin/master/venue-settings/venue-type-and-charges/save', 'Admin\Master\VenueSettingController@save_venue_type_and_charges')->name('admin.masters.venue-settings.venue-type-and-charges.save');
Route::get('admin/master/venue-settings/venue-type-and-charges/edit/{id}', 'Admin\Master\VenueSettingController@edit_venue_type_and_charges')->name('admin.masters.venue-settings.venue-type-and-charges.edit');
Route::post('admin/master/venue-settings/venue-type-and-charges/update', 'Admin\Master\VenueSettingController@update_venue_type_and_charges')->name('admin.masters.venue-settings.venue-type-and-charges.update');
Route::post('admin/master/venue-settings/venue-type-and-charges/delete', 'Admin\Master\VenueSettingController@delete_venue_type_and_charges')->name('admin.masters.venue-settings.venue-type-and-charges.delete');


// VENUE SETTINGS
Route::get('admin/venue-settings', 'Admin\Venue\VenueSettingController@list')->name('admin.venue-settings.list');
Route::get('admin/venue-settings/create', 'Admin\VenueSettingController@create')->name('admin.venue-settings.create');
Route::post('admin/venue-settings/store', 'Admin\VenueSettingController@store')->name('admin.venue-settings.store');
Route::get('admin/venue-settings/edit/{id}', 'Admin\VenueSettingController@edit')->name('admin.venue-settings.edit');
Route::post('admin/venue-settings/get-facility-price', 'Admin\VenueSettingController@get_facility_price')->name('admin.venue-settings.get-facility-price');
Route::post('admin/venue-settings/child-data-delete', 'Admin\VenueSettingController@child_data_delete')->name('admin.venue-settings.child-data-delete');
Route::post('admin/venue-settings/update', 'Admin\VenueSettingController@update')->name('admin.venue-settings.update');
Route::post('admin/venue-settings/delete', 'Admin\VenueSettingController@delete')->name('admin.venue-settings.delete');


// LEADS
Route::get('admin/lead/leads', 'Admin\Lead\LeadController@index')->name('admin.lead.leads');
Route::get('admin/leads/create', 'Admin\Lead\LeadController@create')->name('admin.lead.leads.create');
Route::post('admin/leads/store', 'Admin\Lead\LeadController@store')->name('admin.lead.leads.store');
Route::get('admin/leads/edit/{id}', 'Admin\Lead\LeadController@edit')->name('admin.lead.leads.edit');
Route::post('admin/leads/update', 'Admin\Lead\LeadController@update')->name('admin.lead.leads.update');
Route::post('admin/leads/delete', 'Admin\Lead\LeadController@delete')->name('admin.lead.leads.delete');

// SERVICES
Route::get('admin/service/services', 'Admin\Service\ServiceController@index')->name('admin.service.services');
Route::get('admin/service/create', 'Admin\Service\ServiceController@create')->name('admin.service.services.create');
Route::get('admin/service/edit/{id}', 'Admin\Service\ServiceController@edit')->name('admin.service.services.edit');
Route::post('admin/service/store', 'Admin\Service\ServiceController@store')->name('admin.service.services.store');
Route::post('admin/service/delete', 'Admin\Service\ServiceController@delete')->name('admin.service.services.delete');

// VENDORS
Route::get('admin/vendor/vendors', 'Admin\Vendor\VendorController@index')->name('admin.vendor.vendors');
Route::get('admin/vendor/create', 'Admin\Vendor\VendorController@create')->name('admin.vendor.vendors.create');
Route::get('admin/vendor/edit/{id}', 'Admin\Vendor\VendorController@edit')->name('admin.vendor.vendors.edit');
Route::post('admin/vendor/store', 'Admin\Vendor\VendorController@store')->name('admin.vendor.vendors.store');
Route::post('admin/vendor/delete', 'Admin\Vendor\VendorController@delete')->name('admin.vendor.vendors.delete');

//QUOTATION
Route::get('admin/lead/quotation', 'Admin\Lead\QuotationController@index')->name('admin.lead.quotation');
Route::get('admin/leads/quotation/create', 'Admin\Lead\QuotationController@create')->name('admin.lead.quotation.create');
Route::post('admin/leads/quotation/store', 'Admin\Lead\QuotationController@store')->name('admin.lead.quotation.store');
Route::get('admin/lead/quotation/edit/{id}', 'Admin\Lead\QuotationController@edit')->name('admin.lead.quotation.edit');
Route::post('admin/leads/quotation/update', 'Admin\Lead\QuotationController@update')->name('admin.lead.quotation.update');
Route::post('admin/leads/quotation/delete', 'Admin\Lead\QuotationController@delete')->name('admin.lead.quotation.delete');
Route::get('admin/lead/quotation/show/{id}', 'Admin\Lead\QuotationController@show')->name('admin.lead.quotation.show');


// FOLLOW-UP
Route::get('admin/lead/follow-up', 'Admin\Lead\FollowUpController@index')->name('admin.lead.follow-up');
Route::get('admin/lead/follow-up/create', 'Admin\Lead\FollowUpController@create')->name('admin.lead.follow-up.create');
Route::post('admin/lead/follow-up/store', 'Admin\Lead\FollowUpController@store')->name('admin.lead.follow-up.store');
Route::get('admin/lead/follow-up/edit/{id}', 'Admin\Lead\FollowUpController@edit')->name('admin.lead.follow-up.edit');
Route::post('admin/lead/follow-up/update', 'Admin\Lead\FollowUpController@update')->name('admin.lead.follow-up.update');
Route::post('admin/lead/follow-up/delete', 'Admin\Lead\FollowUpController@delete')->name('admin.lead.follow-up.delete');


// FEEDBACK
Route::get('admin/lead/feedback', 'Admin\Lead\FeedbackController@index')->name('admin.lead.feedback');
Route::get('admin/lead/feedback/create', 'Admin\Lead\FeedbackController@create')->name('admin.lead.feedback.create');
Route::post('admin/lead/feedback/store', 'Admin\Lead\FeedbackController@store')->name('admin.lead.feedback.store');
Route::get('admin/lead/feedback/edit/{id}', 'Admin\Lead\FeedbackController@edit')->name('admin.lead.feedback.edit');
Route::post('admin/lead/feedback/update', 'Admin\Lead\FeedbackController@update')->name('admin.lead.feedback.update');
Route::post('admin/lead/feedback/delete', 'Admin\Lead\FeedbackController@delete')->name('admin.lead.feedback.delete');

// PAYMENT STATUS
Route::get('admin/lead/payemnt-status', 'Admin\Lead\PaymentStatusController@index')->name('admin.lead.payment-status');
Route::get('admin/lead/payemnt-status/create', 'Admin\Lead\PaymentStatusController@create')->name('admin.lead.payment-status.create');
Route::post('admin/lead/payemnt-status/create', 'Admin\Lead\PaymentStatusController@create')->name('admin.lead.payment-status.create');
Route::match(['get', 'post'], 'admin/lead/payemnt-status/edit/{id}','Admin\Lead\PaymentStatusController@edit')->name('admin.lead.payemnt-status.edit');
Route::post('admin/lead/payemnt-status/get-remaining-amount', 'Admin\Lead\PaymentStatusController@get_remaining_amount')->name('admin.lead.payment-status.get-remaining-amount');
Route::post('admin/lead/payment-status/get-amount', 'Admin\Lead\PaymentStatusController@get_amount')->name('admin.lead.payment-status.get-amount');
Route::post('admin/lead/payment-status/delete', 'Admin\Lead\PaymentStatusController@delete')->name('admin.lead.payment-status.delete');

// VENUE BOOKING
// BOOKING
Route::get('admin/venue-booking/venue-book', 'Admin\VenueBooking\VenueBookController@index')->name('admin.venue-booking.venue-book');
Route::get('admin/venue-booking/venue-book/create', 'Admin\VenueBooking\VenueBookController@create')->name('admin.venue-booking.venue-book.create');
Route::post('admin/venue-booking/venue-book/store', 'Admin\VenueBooking\VenueBookController@store')->name('admin.venue-booking.venue-book.store');
Route::get('admin/venue-booking/venue-book/edit/{id}', 'Admin\VenueBooking\VenueBookController@edit')->name('admin.venue-booking.venue-book.edit');
Route::post('admin/venue-booking/venue-book/delete-child-data', 'Admin\VenueBooking\VenueBookController@delete_child_date')->name('admin.venue-booking.venue-book.delete-child-data');
Route::post('admin/venue-booking/venue-book/update', 'Admin\VenueBooking\VenueBookController@update')->name('admin.venue-booking.venue-book.update');
Route::post('admin/venue-booking/venue-book/delete', 'Admin\VenueBooking\VenueBookController@delete')->name('admin.venue-booking.venue-book.delete');


// CALENDAR
Route::get('admin/venue-booking/calendar', 'Admin\VenueBooking\CalendarController@index')->name('admin.venue-booking.calendar');


// DISCOUNT
Route::get('admin/venue-booking/discount', 'Admin\VenueBooking\DiscountController@index')->name('admin.venue-booking.discount');
Route::get('admin/venue-booking/discount/create', 'Admin\VenueBooking\DiscountController@create')->name('admin.venue-booking.discount.create');
Route::post('admin/venue-booking/discount/store', 'Admin\VenueBooking\DiscountController@store')->name('admin.venue-booking.discount.store');
Route::get('admin/venue-booking/discount/edit/{id}', 'Admin\VenueBooking\DiscountController@edit')->name('admin.venue-booking.discount.edit');
Route::post('admin/venue-booking/discount/update', 'Admin\VenueBooking\DiscountController@update')->name('admin.venue-booking.discount.update');
Route::post('admin/venue-booking/discount/delete', 'Admin\VenueBooking\DiscountController@delete')->name('admin.venue-booking.discount.delete');

//venue com items
Route::get('admin/venueComItems/{id}', 'Admin\Venue\VenueController@comItems')->name('admin.venueComItems');
Route::match(['get', 'post'], 'admin/add/venueComItems/{id}', 'Admin\Venue\VenueController@addcomItems')->name('admin.add.venueComItems');
Route::match(['get', 'post'], 'admin/edit/comitems/{itemid}/{id}', 'Admin\Venue\VenueController@editcomItems')->name('admin.edit.comitems');
Route::get('admin/comitemsdelete/{id}', 'Venue\VenueController@deletecomItems')->name('admin.comitemsdelete');

//venue Ex Cost Items
Route::get('admin/venueCostItems/{id}', 'Admin\Venue\VenueController@costItems')->name('admin.venueCostItems');
Route::match(['get', 'post'], 'admin/add/CostItems/{id}', 'Admin\Venue\VenueController@addCostItems')->name('admin.add.CostItems');
Route::match(['get', 'post'], 'admin/edit/CostItems/{itemid}/{id}', 'Admin\Venue\VenueController@editCostItems')->name('admin.edit.CostItems');
Route::get('admin/CostItemsdelete/{id}', 'Admin\Venue\VenueController@deletecostItems')->name('admin.CostItemsdelete');

// -----------------------------------------------------------------------------  BSM  -----------------------------------------------------------------------

//BSM Login
Route::match(['get','post'],'bsm', 'BSM\bsmController@bsmlogin')->name('bsm');

Route::group(['middleware' => ['bsm']], function () {

  Route::get('bsm/dashboard', 'BSM\bsmController@dashboard')->name('bsm.dashboard');
  // PROFILE ROUTES
  Route::match(['get','post'],'bsm/edit/prifle/{id}', 'BSM\bsmController@edit_profile')->name('bsm.edit.prifle');
  Route::match(['get','post'],'bsm/change_password/{id}', 'BSM\bsmController@change_password')->name('bsm.change.password');

});

Route::get('bsm_logout', 'BSM\bsmController@logout')->name('bsm.logout');


// -----------------------------------------------------------------------------  CSM  -----------------------------------------------------------------------
//CSM Login
Route::match(['get','post'],'csm', 'CSM\csmController@csmlogin')->name('csm');

Route::group(['middleware' => ['csm']], function () {

  Route::get('csm/dashboard', 'CSM\csmController@dashboard')->name('csm.dashboard');
  // PROFILE ROUTES
  Route::match(['get','post'],'csm/edit/prifle/{id}', 'CSM\csmController@edit_profile')->name('csm.edit.prifle');
  Route::match(['get','post'],'csm/change_password/{id}', 'CSM\csmController@change_password')->name('csm.change.password');

});

Route::get('csm_logout', 'CSM\csmController@logout')->name('csm.logout');

// -----------------------------------------------------------------------------  Vanue  -----------------------------------------------------------------------
//Venue Login
Route::match(['get','post'],'venue', 'Venue\venueController@venuelogin')->name('venue');

Route::group(['middleware' => ['venue']], function () {

  Route::get('venue/dashboard', 'Venue\venueController@dashboard')->name('venue.dashboard');
  // PROFILE ROUTES
  Route::match(['get','post'],'venue/edit/prifle/{id}', 'Venue\venueController@edit_profile')->name('venue.edit.prifle');
  Route::match(['get','post'],'venue/change_password/{id}', 'Venue\venueController@change_password')->name('venue.change.password');

});

Route::get('venue_logout', 'Venue\venueController@logout')->name('venue.logout');

// -----------------------------------------------------------------------------  vendor  -----------------------------------------------------------------------
//vendor Login
Route::match(['get','post'],'vendor', 'Vendor\vendorController@vendorlogin')->name('vendor');

Route::group(['middleware' => ['vendor']], function () {

  Route::get('vendor/dashboard', 'Vendor\vendorController@dashboard')->name('vendor.dashboard');
  // PROFILE ROUTES
  Route::match(['get','post'],'vendor/edit/prifle/{id}', 'Vendor\vendorController@edit_profile')->name('vendor.edit.prifle');
  Route::match(['get','post'],'vendor/change_password/{id}', 'Vendor\vendorController@change_password')->name('vendor.change.password');

});

Route::get('vendor_logout', 'Vendor\vendorController@logout')->name('vendor.logout');