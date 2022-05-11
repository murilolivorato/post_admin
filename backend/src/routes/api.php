<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/* ------------------------------------------------------- LOAD POSTS */
Route::get('/site/load-main-options' ,            ['uses'         => 'App\Http\Controllers\SiteController@load_main_options' ]);
Route::get('/post/load-display' ,                  ['uses'         => 'App\Http\Controllers\PostsController@load_display' ]);
Route::get('/post/load-results' ,                  ['uses'         => 'App\Http\Controllers\PostsController@load_results' ]);
Route::get('/post/load-unique-options' ,           [ 'uses'        => 'App\Http\Controllers\PostsController@load_unique_options' ]);

Route::get('/post/load-last-posts' ,               ['uses'         => 'App\Http\Controllers\PostsController@load_last_posts' ]);
Route::get('/post/load-form-options' ,             ['uses'         => 'App\Http\Controllers\PostsController@load_form_options' ]);
Route::get('/post/load-form/{url_title}' ,         ['uses'         => 'App\Http\Controllers\PostsController@load_form' ]);

Route::get('/post/load-form/{url_title}' ,         ['uses'         => 'App\Http\Controllers\PostController@load_form' ]);
Route::get('/post/reload-nav-link',                [ 'uses'        => 'App\Http\Controllers\PostController@reload_nav_link']);
Route::get('/post/list-session',                   [ 'uses'        => 'App\Http\Controllers\PostController@list_session']);
Route::get('/post/load-image-gallery/{id}',             [ 'uses'        => 'App\Http\Controllers\PostController@load_image_gallery']);
Route::get('/post/load-file-gallery/{id}',              [ 'uses'        => 'App\Http\Controllers\PostController@load_file_gallery']);


Route::post('/admin/post-login',  [ 'uses'        => 'App\Http\Controllers\AdminAuthController@postLogin']);
Route::post('/admin/logout',      [ 'uses'        => 'App\Http\Controllers\AdminAuthController@getLogout']);


Route::get('/get-captcha' ,               [ 'uses'        => 'App\Http\Controllers\CaptchaImage@getValueSession' ]);

Route::get('product/load-display'           , ['uses' => 'App\Http\Controllers\ProductsController@load_display']);
Route::get('product/load-form-options'      , ['uses' => 'App\Http\Controllers\ProductsController@load_form_options']);
Route::get('product/load-form/{id}'         , ['uses' => 'App\Http\Controllers\ProductController@load_form']);




Route::group(['middleware' => ['auth:user_admin']] , function() {
    Route::post('/admin/info' ,                                        [ 'uses'        => 'App\Http\Controllers\AdminAuthController@info' ]);




    /* --------------------------------------------------------------------------------------------  POSTS
  -------------------------------------------------------------------------------------------------------------  */

    // POST
    Route::get('admin/post/load-display'                     , ['uses'         => 'App\Http\Controllers\Admin\PostController@load_display' ]);
    Route::get('admin/post/load-form-options'                , ['uses'         => 'App\Http\Controllers\Admin\PostController@load_form_options' ]);
    Route::post('admin/post/upload-images'                   , [ 'uses'        => 'App\Http\Controllers\Admin\PostController@upload_images' ]);
    Route::get('admin/post/load-form/{id}'                   , [ 'uses'        => 'App\Http\Controllers\Admin\PostController@load_form' ]);
    Route::post('admin/post/store'                           , ['uses'         => 'App\Http\Controllers\Admin\PostController@store' ]);
    Route::post('admin/post/update/{id}'                     , [ 'uses'        => 'App\Http\Controllers\Admin\PostController@update' ]);
    Route::post('admin/post/destroy'                         , [ 'uses'        => 'App\Http\Controllers\Admin\PostController@destroy' ]);


    // POST CATEGORY
    Route::post('admin/post-category/store'                 , ['uses' => 'App\Http\Controllers\Admin\PostCategoryController@store']);
    Route::post('admin/post-category/update/{id}'           , ['uses' => 'App\Http\Controllers\Admin\PostCategoryController@update']);
    Route::get('admin/post-category/load-display'           , ['uses' => 'App\Http\Controllers\Admin\PostCategoryController@load_display']);
    Route::post('admin/post-category/destroy'               , ['uses' => 'App\Http\Controllers\Admin\PostCategoryController@destroy']);
    Route::post('admin/post-category/load-form/{id}'        , ['uses' => 'App\Http\Controllers\Admin\PostCategoryController@loadForm']);

    // POST USER
    Route::get('admin/post-user'                            , [ 'uses'        => 'App\Http\Controllers\Admin\PostUserController@index' ]);
    Route::get('admin/post-user/load-display'               , [ 'uses'        => 'App\Http\Controllers\Admin\PostUserController@load_display']);
    Route::post('admin/post-user/store'                     , [ 'uses'        => 'App\Http\Controllers\Admin\PostUserController@store']);
    Route::post('admin/post-user/update/{id}'               , [ 'uses'        => 'App\Http\Controllers\Admin\PostUserController@update']);
    Route::post('admin/post-user/destroy'                   , [ 'uses'        => 'App\Http\Controllers\Admin\PostUserController@destroy']);

    // POST TAG
    Route::get('admin/post-tag'                            , [  'uses' => 'App\Http\Controllers\Admin\PostTagController@index']);
    Route::get('admin/post-tag/load-display'               , [ 'uses' => 'App\Http\Controllers\Admin\PostTagController@load_display' ]);
    Route::post('admin/post-tag/store'                     , [ 'uses' => 'App\Http\Controllers\Admin\PostTagController@store' ]);
    Route::post('admin/post-tag/update/{id}'               , [ 'uses' => 'App\Http\Controllers\Admin\PostTagController@update' ]);
    Route::post('admin/post-tag/destroy'                   , [  'uses' => 'App\Http\Controllers\Admin\PostTagController@destroy' ]);

    /* --------------------------------------------------------------------------------------------  PRODUCT
  -------------------------------------------------------------------------------------------------------------  */

    // PRODUCT
    Route::post('admin/product/store'                 , ['uses' => 'App\Http\Controllers\Admin\ProductController@store']);
    Route::post('admin/product/update/{id}'           , ['uses' => 'App\Http\Controllers\Admin\ProductController@update']);
    Route::post('admin/product/upload-images'         , ['uses' => 'App\Http\Controllers\Admin\ProductController@upload_image' ]);
    Route::get('admin/product/load-display'           , ['uses' => 'App\Http\Controllers\Admin\ProductController@load_display']);
    Route::get('admin/product/load-form-options'      , ['uses' => 'App\Http\Controllers\Admin\ProductController@load_form_options']);
    Route::post('admin/product/destroy'               , ['uses' => 'App\Http\Controllers\Admin\ProductController@destroy']);
    Route::get('admin/product/load-form/{id}'         , ['uses' => 'App\Http\Controllers\Admin\ProductController@load_form']);
    Route::get('admin/product/load-sub-category/{id}' , ['uses' => 'App\Http\Controllers\Admin\ProductController@load_sub_category']);



    // PRODUCT CATEGORY
    Route::post('admin/product-category/store'                 , ['uses' => 'App\Http\Controllers\Admin\ProductCategoryController@store']);
    Route::post('admin/product-category/update/{id}'           , ['uses' => 'App\Http\Controllers\Admin\ProductCategoryController@update']);
    Route::get('admin/product-category/load-display'           , ['uses' => 'App\Http\Controllers\Admin\ProductCategoryController@load_display']);
    Route::post('admin/product-category/upload-images'         , [ 'uses' => 'App\Http\Controllers\Admin\ProductCategoryController@upload_images' ]);
    Route::post('admin/product-category/destroy'               , ['uses' => 'App\Http\Controllers\Admin\ProductCategoryController@destroy']);
    Route::get('admin/product-category/load-form/{id}'         , ['uses' => 'App\Http\Controllers\Admin\ProductCategoryController@load_form' ]);

    // PRODUCT SUB CATEGORY
    Route::post('admin/product-sub-category/store'                 , ['uses'  => 'App\Http\Controllers\Admin\ProductSubCategoryController@store']);
    Route::post('admin/product-sub-category/update/{id}'           , ['uses'  => 'App\Http\Controllers\Admin\ProductSubCategoryController@update']);
    Route::get('admin/product-sub-category/load-display'           , ['uses'  => 'App\Http\Controllers\Admin\ProductSubCategoryController@load_display']);
    Route::post('admin/product-sub-category/upload-images'         , [ 'uses' => 'App\Http\Controllers\Admin\ProductSubCategoryController@upload_images' ]);
    Route::get('admin/product-sub-category/load-form-options'      , ['uses'  => 'App\Http\Controllers\Admin\ProductSubCategoryController@load_form_options']);
    Route::post('admin/product-sub-category/destroy'               , ['uses'  => 'App\Http\Controllers\Admin\ProductSubCategoryController@destroy']);
    Route::get('admin/product-sub-category/load-form/{id}'         , ['uses'  => 'App\Http\Controllers\Admin\ProductSubCategoryController@load_form']);


    // PRODUCT TAG
    Route::post('admin/product-tag/store'                 , ['uses' => 'App\Http\Controllers\Admin\ProductTagController@store']);
    Route::post('admin/product-tag/update/{id}'           , ['uses' => 'App\Http\Controllers\Admin\ProductTagController@update']);
    Route::get('admin/product-tag/load-display'           , ['uses' => 'App\Http\Controllers\Admin\ProductTagController@load_display']);
    Route::post('admin/product-tag/destroy'               , ['uses' => 'App\Http\Controllers\Admin\ProductTagController@destroy']);

    // PRODUCT DISCOUNT
    Route::post('admin/product-discount/store'                 , ['uses' => 'App\Http\Controllers\Admin\ProductDiscountController@store']);
    Route::post('admin/product-discount/update/{id}'           , ['uses' => 'App\Http\Controllers\Admin\ProductDiscountController@update']);
    Route::get('admin/product-discount/load-display'           , ['uses' => 'App\Http\Controllers\Admin\ProductDiscountController@load_display']);
    Route::get('admin/product-discount/load-form-options'       , ['uses' => 'App\Http\Controllers\Admin\ProductDiscountController@load_form_options']);
    Route::post('admin/product-discount/destroy'               , ['uses' => 'App\Http\Controllers\Admin\ProductDiscountController@destroy']);
    Route::get('admin/product-discount/load-form/{id}'        , ['uses' => 'App\Http\Controllers\Admin\ProductDiscountController@load_form']);


    // PRODUCT SEARCH KEY
    Route::post('admin/product-search-key/store'                 , ['uses' => 'App\Http\Controllers\Admin\ProductSearchKeyController@store']);
    Route::post('admin/product-search-key/update/{id}'           , ['uses' => 'App\Http\Controllers\Admin\ProductSearchKeyController@update']);
    Route::get('admin/product-search-key/load-display'           , ['uses' => 'App\Http\Controllers\Admin\ProductSearchKeyController@load_display']);
    Route::post('admin/product-search-key/destroy'               , ['uses' => 'App\Http\Controllers\Admin\ProductSearchKeyController@destroy']);

    // PRODUCT OPTION
    Route::get('admin/product-option/load-form-options'       , ['uses' => 'App\Http\Controllers\Admin\ProductOptionController@load_form_options']);


    // PRODUCT GLOBAL OPTION
    Route::post('admin/product-global-option/store'                 , ['uses' => 'App\Http\Controllers\Admin\ProductGlobalOptionController@store']);
    Route::post('admin/product-global-option/update/{id}'           , ['uses' => 'App\Http\Controllers\Admin\ProductGlobalOptionController@update']);
    Route::get('admin/product-global-option/load-display'           , ['uses' => 'App\Http\Controllers\Admin\ProductGlobalOptionController@load_display']);
    Route::get('admin/product-global-option/load-form-options'       , ['uses' => 'App\Http\Controllers\Admin\ProductGlobalOptionController@load_form_options']);
    Route::post('admin/product-global-option/destroy'               , ['uses' => 'App\Http\Controllers\Admin\ProductGlobalOptionController@destroy']);
    Route::get('admin/product-global-option/load-form/{id}'        , ['uses' => 'App\Http\Controllers\Admin\ProductGlobalOptionController@load_form']);
    Route::get('admin/product-global-option/load-option-list-by-id/{id}'        , ['uses' => 'App\Http\Controllers\Admin\ProductGlobalOptionController@load_option_list_by_id']);

    // PRODUCT MANUFACTORY
    Route::post('admin/product-manufacture/store'                 , ['uses' => 'App\Http\Controllers\Admin\ProductManufactureController@store']);
    Route::post('admin/product-manufacture/update/{id}'           , ['uses' => 'App\Http\Controllers\Admin\ProductManufactureController@update']);
    Route::post('admin/product-manufacture/upload-images'         , [ 'uses'        => 'App\Http\Controllers\Admin\ProductManufactureController@upload_images' ]);
    Route::get('admin/product-manufacture/load-display'           , ['uses' => 'App\Http\Controllers\Admin\ProductManufactureController@load_display']);
    Route::get('admin/product-manufacture/load-form-options'       , ['uses' => 'App\Http\Controllers\Admin\ProductManufactureController@load_form_options']);
    Route::post('admin/product-manufacture/destroy'               , ['uses' => 'App\Http\Controllers\Admin\ProductManufactureController@destroy']);
    Route::get('admin/product-manufacture/load-form/{id}'        , ['uses' => 'App\Http\Controllers\Admin\ProductManufactureController@load_form']);




    /* ------------------------------------------------------------------------------------------------      IMAGE GALLERY
    -------------------------------------------------------------------------------------------------------------  */

    Route::get('admin/image-gallery/load-display'           , ['uses'        => 'App\Http\Controllers\Admin\ImageGalleryController@load_display' ]);
    Route::get('admin/image-gallery/load-form-options'      , ['uses'        => 'App\Http\Controllers\Admin\ImageGalleryController@load_form_options' ]);
    Route::get('admin/image-gallery/load-form/{id}'         , ['uses'        => 'App\Http\Controllers\Admin\ImageGalleryController@load_form' ]);
    Route::post('admin/image-gallery/upload-image'          , ['uses'        => 'App\Http\Controllers\Admin\ImageGalleryController@upload_image' ]);
    Route::post('admin/image-gallery/delete-image-uploaded' , ['uses'        => 'App\Http\Controllers\Admin\ImageGalleryController@delete_image_uploaded' ]);
    Route::post('admin/image-gallery/store'                 , ['uses'        => 'App\Http\Controllers\Admin\ImageGalleryController@store' ]);
    Route::post('admin/image-gallery/update/{id}'           , ['uses'        => 'App\Http\Controllers\Admin\ImageGalleryController@update' ]);
    Route::post('admin/image-gallery/destroy'               , ['uses'        => 'App\Http\Controllers\Admin\ImageGalleryController@destroy' ]);


    /* ------------------------------------------------------------------------------------------------      FILE GALLERY
    -------------------------------------------------------------------------------------------------------------  */
    Route::get('admin/file-gallery/load-display'            , ['uses'        => 'App\Http\Controllers\Admin\FileGalleryController@load_display' ]);
    Route::get('admin/file-gallery/load-form-options'       , ['uses'        => 'App\Http\Controllers\Admin\FileGalleryController@load_form_options' ]);
    Route::get('admin/file-gallery/load-form/{id}'          , ['uses'        => 'App\Http\Controllers\Admin\FileGalleryController@load_form' ]);
    Route::post('admin/file-gallery/upload-file'            , ['uses'        => 'App\Http\Controllers\Admin\FileGalleryController@upload_file' ]);
    Route::post('admin/file-gallery/delete-file-uploaded'   , ['uses'        => 'App\Http\Controllers\Admin\FileGalleryController@delete_file_uploaded' ]);
    Route::get('admin/file-gallery/criar'                   , ['uses'        => 'App\Http\Controllers\Admin\FileGalleryController@create' ]);
    Route::post('admin/file-gallery/store'                  , ['uses'        => 'App\Http\Controllers\Admin\FileGalleryController@store' ]);
    Route::get('admin/file-gallery/editar/{id}'             , ['uses'        => 'App\Http\Controllers\Admin\FileGalleryController@edit'  ]);
    Route::post('admin/file-gallery/update/{id}'            , ['uses'        => 'App\Http\Controllers\Admin\FileGalleryController@update' ]);
    Route::post('admin/file-gallery/destroy'                , ['uses'        => 'App\Http\Controllers\Admin\FileGalleryController@destroy' ]);



    /* ------------------------------------------------------------------------------------------------      ADMIN USER
    -------------------------------------------------------------------------------------------------------------  */
    Route::get('admin/admin-user/load-display'             , ['uses'        => 'App\Http\Controllers\Admin\AdminUserController@load_display' ]);
    Route::post('admin/admin-user/upload-images'           , ['uses'        => 'App\Http\Controllers\Admin\AdminUserController@upload_images' ]);
    Route::get('admin/admin-user/load-form-options'        , ['uses'        => 'App\Http\Controllers\Admin\AdminUserController@load_form_options' ]);
    Route::get('admin/admin-user/load-form/{id}'           , ['uses'        => 'App\Http\Controllers\Admin\AdminUserController@load_form' ]);
    Route::post('admin/admin-user/store'                   , ['uses'        => 'App\Http\Controllers\Admin\AdminUserController@store' ]);
    Route::post('admin/admin-user/update/{id}'             , ['uses'        => 'App\Http\Controllers\Admin\AdminUserController@update' ]);
    Route::post('admin/admin-user/update-password/{id}'    , ['uses'        => 'App\Http\Controllers\Admin\AdminUserController@update_password' ]);
    Route::post('admin/admin-user/destroy'                 , ['uses'        => 'App\Http\Controllers\Admin\AdminUserController@destroy' ]);

});


// PASSWORD
Route::post('/password/post-reset'                        , [ 'uses'        => 'App\Http\Controllers\ForgotPassController@postResetPass' ]);
Route::get('/password/load-form-recover-pass/{token}'     , [ 'uses'        => 'App\Http\Controllers\ForgotPassController@loadFormPasswordReset' ]);
Route::post('/password/post-recover'                      , [ 'uses'        => 'App\Http\Controllers\ForgotPassController@postRecoverPass' ]);

/*Route::middleware('auth:api')->get('/customer/info' ,                 [ 'uses'        => 'CustomerAuthController@info' ]);*/


Route::post('oauth/token', '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');

