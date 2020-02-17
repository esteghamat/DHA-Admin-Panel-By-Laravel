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

/*
//***********  Good sample for check route in Ajax ***********
Route::post('/admin/delete_marka', function()
{
    return 'Success! ajax in laravel 5';
});
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', 'HomeController@index')->name('home');

// ******************************** Web site ********************************
// Route::get('/clear-cache', function() {
//   $exitCode = Artisan::call('cache:clear');
//   // return what you want
// });

Route::get('/', 'SiteController@index');
Route::get('/who-we-are', 'SiteController@whoweare');
Route::get('/digitalrecetemiz', 'SiteController@digitalrecetemiz');
Route::get('/references', 'SiteController@references');
Route::get('/work-samples', 'SiteController@worksamples');
Route::get('/blog', 'SiteController@blog');
Route::get('/blog/blogdetails/{blog_slug}', 'SiteController@blogdetails');
Route::get('/contact', 'SiteController@contact');
Route::post('/contact/send_email', 'SiteController@contactus_savemessage_sendemail');

// ********************************  Admin ********************************
Route::match(['get' , 'post'] , '/admin', 'AdminController@login');
Route::get('/logout', 'AdminController@logout');
Auth::routes();
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('/admin/settings', 'AdminController@settings');
Route::get('/admin/check_password', 'AdminController@check_password');
Route::post('/admin/update_password', 'AdminController@update_password');
Route::get('/admin/load_contenttype', 'AdminController@loadContenttype'); 

// ******************************** Config Types ********************************
Route::get('/admin/configtype', 'ConfigtypeController@indexConfigTypes');
Route::match(['get','post'] , '/admin/add_configtype', 'ConfigtypeController@addConfigType');
Route::get('/admin/edit_row_configtype{id}' , 'ConfigtypeController@editRowConfigType');
Route::post('/admin/update_configtype', 'ConfigtypeController@updateConfigType');
Route::post('/admin/delete_possibility_config_type', 'ConfigtypeController@deletePassibilityConfigType');
Route::post('/admin/delete_config_type', 'ConfigtypeController@deleteConfigType');

// ******************************** Configs ********************************
Route::get('/admin/config', 'ConfigController@indexConfig');
Route::match(['get','post'] , '/admin/add_edit_config/', 'ConfigController@addConfig');
Route::match(['get','post'] , '/admin/add_edit_config/{config_id}', 'ConfigController@editRowConfig');
Route::post('/admin/update_config', 'ConfigController@updateConfig');
Route::post('/admin/delete_possibility_site_config', 'ConfigController@deletePassibilityConfig');
Route::post('/admin/delete_site_config', 'ConfigController@deleteConfig');

// ********************************  Marka ********************************
Route::match(['get'] , '/marka/{marka_slug}' , 'MarkaController@showMarka');
Route::match(['get'] , '/marka' , 'MarkaController@indexMarka');
Route::match(['get','post'] , '/admin/add_marka' , 'MarkaController@addMarka');
Route::match(['get'] , '/admin/edit_row_marka{id}' , 'MarkaController@editRowMarka');
Route::match(['get','post'] ,'/admin/update_marka' , 'MarkaController@updateMarka');
Route::post('/admin/delete_possibility_marka', 'MarkaController@deletePassibilityMarka');
Route::post('/admin/delete_marka', 'MarkaController@deleteMarka');

// ********************************  Category ********************************
Route::match(['get'] , '/category/{category_slug}' , 'CategoryController@showCategory');
Route::match(['get'] , '/category' , 'CategoryController@indexCategory');
Route::match(['get','post'] , '/admin/add_category' , 'CategoryController@addCategory');
Route::match(['get'] , '/admin/edit_row_category{id}' , 'CategoryController@editRowCategory');
Route::match(['get','post'] ,'/admin/update_category' , 'CategoryController@updateCategory');
Route::post('/admin/delete_possibility_category', 'CategoryController@deletePassibilityCategory');
Route::post('/admin/delete_category', 'CategoryController@deleteCategory');

// ******************************** Portfolio ********************************
// Route::match(['get'] , '/portfolio/{portfolio_slug}' , 'PortfolioController@showPortfolio');
// Route::match(['get'] , '/portfolio' , 'PortfolioController@indexPortfolio');
// Route::match(['get','post'] , '/admin/add_portfolio' , 'PortfolioController@addPortfolio');
// Route::match(['get'] , '/admin/edit_row_portfolio{id}' , 'PortfolioController@editRowPortfolio');
// Route::match(['get','post'] ,'/admin/update_portfolio' , 'PortfolioController@updatePortfolio');
// Route::post('/admin/delete_possibility_portfolio', 'PortfolioController@deletePassibilityPortfolio');
// Route::post('/admin/delete_portfolio', 'PortfolioController@deletePortfolio');

// ******************************** Image Gallery ********************************
Route::match(['get'] , '/admin/index_insert_gallery_image/{id}/{ref_title}/{ref_type}/{display_type}' , 'GalleryImageController@indexInsertImage');
Route::match(['get','post'] , '/admin/index_insert_gallery_image' , 'GalleryImageController@insertImage');
Route::post('/admin/delete_gallery_image', 'GalleryImageController@deleteGalleryImage');
Route::get('/admin/edit_row_gallery_image{id}' , 'GalleryImageController@editRowGalleryImage');
Route::post('/admin/update_gallery_image', 'GalleryImageController@updateGalleryImage');

// ******************************** Gallery ********************************
Route::match(['get'] , '/admin/index_gallery' , 'GalleryController@indexGallery');

// ********************************  Filters ********************************
Route::match(['get'] , '/admin/filter/{filter_slug}' , 'FilterController@showFilter');
Route::match(['get'] , '/admin/filter' , 'FilterController@indexFilter');
Route::match(['get','post'] , '/admin/add_filter' , 'FilterController@addFilter');
Route::match(['get'] , '/admin/edit_row_filter{id}' , 'FilterController@editRowFilter');
Route::match(['get','post'] ,'/admin/update_filter' , 'FilterController@updateFilter');
Route::post('/admin/delete_possibility_filter', 'FilterController@deletePassibilityFilter');
Route::post('/admin/delete_filter', 'FilterController@deleteFilter');

// ********************************  Content Types ********************************
Route::match(['get'] , '/admin/contenttype/{contenttype_slug}' , 'ContenttypeController@showContentType');
Route::match(['get'] , '/admin/contenttype' , 'ContenttypeController@indexContentType');
Route::match(['get','post'] , '/admin/add_contenttype' , 'ContenttypeController@addContentType');
Route::match(['get'] , '/admin/edit_row_contenttype{id}' , 'ContenttypeController@editRowContentType');
Route::match(['get','post'] ,'/admin/update_contenttype' , 'ContenttypeController@updateContentType');
Route::post('/admin/delete_possibility_site_content_type', 'ContenttypeController@deletePassibilityContentType');
Route::post('/admin/delete_site_content_type', 'ContenttypeController@deleteContentType');

// ********************************  Head Content ********************************
Route::match(['get'] , '/contenthead/{contenthead_slug}' , 'ContentheadController@showContentHead');
Route::match(['get'] , '/contenthead' , 'ContentheadController@indexContentHead');
Route::match(['get','post'] , '/admin/add_contenthead' , 'ContentheadController@addContentHead');
Route::match(['get'] , '/admin/edit_row_contenthead{id}' , 'ContentheadController@editRowContentHead');
Route::match(['get','post'] ,'/admin/update_contenthead' , 'ContentheadController@updateContentHead');
Route::post('/admin/delete_possibility_site_head_content', 'ContentheadController@deletePassibilityContentHead');
Route::post('/admin/delete_site_head_content', 'ContentheadController@deleteContentHead'); 

// ********************************  Item Content ********************************
Route::match(['get'] , '/contentitem' , 'ContentitemController@setDefaultFor_IndexContentItem');
Route::match(['get'] , '/contentitem/{contenttype_slug}' , 'ContentitemController@indexContentItem');
Route::match(['get'] , '/contentitem/{contenttype_slug}/{contentitem_slug}/' , 'ContentitemController@showContentItem');
Route::match(['get','post'] , '/admin/add_contentitem/{contenttype_id}' , 'ContentitemController@addContentItem');
Route::match(['get','post'] , '/admin/add_contentitem' , 'ContentitemController@addContentItem');
Route::match(['get'] , '/admin/edit_row_contentitem/{id}' , 'ContentitemController@editRowContentItem');
Route::match(['get','post'] ,'/admin/update_contentitem' , 'ContentitemController@updateContentItem');
Route::post('/admin/delete_possibility_site_content_item', 'ContentitemController@deletePassibilityContentItem');
Route::post('/admin/delete_site_content_item', 'ContentitemController@deleteContentItem'); 
Route::post('/admin/reorder_contentitem', 'ContentitemController@reOrderContentItem');

// ********************************  test - Variables_value ********************************
// Route::match(['get'] , '/test/variables_value_view' , 'ContentheadController@dddd'); 



