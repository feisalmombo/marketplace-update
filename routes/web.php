<?php
use App\InstitutionType;
use App\LoanType;
use App\Duration;
use App\Product;
use Illuminate\Support\Facades\Input;
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
    $loantype = DB::table('loan_types')
    ->select('id','loan_name','created_at')
    ->latest()
    ->get();

    $documentsDatas = DB::table('documents')
    ->join('users', 'documents.user_id', '=', 'users.id')

    ->select(
    'documents.id',
    'documents.name',
    'documents.file_path',
    'documents.created_at')
    ->latest()
    ->get();

    return view('welcome')
    ->with('loantype', $loantype)
    ->with('documentsDatas', $documentsDatas);
    });

    Route::get('locale/{locale}', function ($locale) {
        Session::put('locale', $locale);

        return redirect()->back();

        // This Link will add session of language when they click to change language
    });

    Route::get('/compare/search/loan/locale/{locale}', function ($locale) {
        Session::put('locale', $locale);

        return redirect()->back();

        // This Link will add session of language when they click to change language
    });

    Route::get('/apply/request/{id}/locale/{locale}', function ($locale) {
        Session::put('locale', $locale);

        return redirect()->back();
    });

    Route::get('/login/locale/{locale}', function ($locale) {
        Session::put('locale', $locale);

        return redirect()->back();
    });

// ROUTE FOR SEARCHCOMPARE CONTROLLER
Route::get('/compare/search/loan', ['as'=>'compare/search/loan','uses'=>'SearchComparesController@showComparesearchloan']);
Route::post('/compare/search/loan', ['as'=>'compare/search/loan','uses'=>'SearchComparesController@comparesearchloan']);


Route::post('/download/report', ['as'=>'/download/report','uses'=>'SearchComparesController@downloadreport']);
Route::post('/call-me/request', ['as'=>'/call-me/request','uses'=>'SearchComparesController@callmerequest']);

Route::get('/apply/request/{id}', ['as'=>'/apply/request/{id}','uses'=>'SearchComparesController@showAllcomparisonLoan']);
Route::get('/explore/details/{id}', ['as'=>'/explore/details/{id}','uses'=>'SearchComparesController@exploreDetails']);


// ROUTE FOR PDF
Route::post('/compare/search/loan/report/pdf/{view_type}', 'SearchComparesController@report');

// ROUTE FOR PLACEREQUESTS CONTROLLER
Route::resource('/apply/request', 'PlaceRequestsController');
Route::post('/apply/request', 'PlaceRequestsController@store');

Route::get('/loan/requests', 'PlaceRequestsController@getloanRequests');
Route::get('/loan/requests/{id}', 'PlaceRequestsController@showloanRequests');
Route::post('/loan/requests/post', 'PlaceRequestsController@postloanRequests');

Route::delete('/loan/requests/{id}', 'PlaceRequestsController@deleteLoanrequests');

Route::get('/loan/applied', 'PlaceRequestsController@loanApplied');
Route::get('/loan/approved', 'PlaceRequestsController@loanApproved');
Route::get('/loan/pending', 'PlaceRequestsController@loanPending');

Route::get('/all/loan/rejected', 'PlaceRequestsController@allLoanRejected');
Route::get('/loan/rejected', 'PlaceRequestsController@loanRejected');

// FOR ALL TOTAL LOANs APPROVED AND REJECTED
Route::get('/total/loans/rejected/approved', 'PlaceRequestsController@totalRejectedApproved');

// FOR LOAN APPROVED
Route::get('/total/loan/approved', 'PlaceRequestsController@TotalFromloanApproved');


Route::resource('/view-users/profile/photo/upload', 'ProfilePhotoUploads');
Route::post('/view-users/profile/photo/upload', 'ProfilePhotoUploads@store');

// Authentication Routes...
Route::get('login', [
	'as' => 'login',
	'uses' => 'Auth\LoginController@showLoginForm'
  ]);
  Route::post('login', [
	'as' => '',
	'uses' => 'Auth\LoginController@login'
  ]);
  Route::post('logout', [
	'as' => 'logout',
	'uses' => 'Auth\LoginController@logout'
  ]);

  // Password Reset Routes...
  Route::post('password/email', [
	'as' => 'password.email',
	'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
  ]);
  Route::get('password/reset', [
	'as' => 'password.request',
	'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
  ]);
  Route::post('password/reset', [
	'as' => 'password.update',
	'uses' => 'Auth\ResetPasswordController@reset'
  ]);
  Route::get('password/reset/{token}', [
	'as' => 'password.reset',
	'uses' => 'Auth\ResetPasswordController@showResetForm'
  ]);

// Route for New view/blade user change password
Route::get('/change_password', function () {
    return view('auth.passwords.new_user_change_pwd');
});

// ChangePassword Route Controller
Route::post('/change_password', 'ChangePasswordController@updateNewuser');


Route::resource('/change-password', 'ChangePasswordController');
Route::post('/change-password', 'ChangePasswordController@update');

// Route for CheckUserStatus Middleware
Route::group(['middleware' => 'CheckUserStatus'], function () {

    // Route for ValidateButtonHistory Middleware
    Route::group(['middleware' => 'ValidateButtonHistory'], function () {

        // Route for Auth Middleware
        Route::group(['middleware' => 'auth'], function () {

            // Home Route Controller
            Route::get('/home', 'HomeController@index')->name('home');

            // ViewUser Route Controller allSystemsUsers
            Route::resource('/view-users', 'ViewUsersController');
            Route::post('/view-users', 'ViewUsersController@store');
            Route::get('/reset/{id}', 'ViewUsersController@resetpwd');
            Route::get('/view-users/profile', 'ViewUsersController@show');

            Route::get('/view/all/users', 'ViewUsersController@allSystemsUsers');

            Route::get('/personal/information', 'ViewUsersController@personalInfo');
            Route::get('/employment/information', 'PlaceRequestsController@employmentInfo');

            Route::get('/subscriber-email/{id}','SubscriberController@show');
            Route::post('/subscriber-email/send','SubscriberController@subscriberReplyEmail');

            //ROUTE FOR TERMS AND CONDITIONS REPRESENTED BY DOCUMENTSCONTROLLER
            Route::resource('/documents/terms/conditions', 'DocumentsController');

             // ROUTE FOR LOAN REQUESTS
             Route::resource('/loan/request/approves', 'LoanRequestApprovesController');
             Route::post('/loan/request/approves/send','LoanRequestApprovesController@replyApprove');
             Route::get('/loan/request/banker/approved','LoanRequestApprovesController@bankerApproved');
            Route::get('/borrower/loan/request/banker/approved','LoanRequestApprovesController@singleBankerApproved');

            // ROUTE FOR SUBSCRIBER CONTROLLER
            Route::resource('/subscriber-email','SubscriberController');
            Route::get('/subscriber-email','SubscriberController@index');

            // ROUTE FOR PRODUCTUPLOADS CONTROLLER
            Route::resource('/product/uploads', 'LoanRatesController');
            Route::post('/product/uploads', 'LoanRatesController@store');

            // ROUTE FOR SEARCHCOMPARES CONTROLLER WITHIN A DASHBOARD
            Route::get('/product/inquries', ['as'=>'/product/inquries','uses'=>'SearchComparesController@viewdownloadreport']);
            Route::get('/product/inquries/download', ['as'=>'/product/inquries/download','uses'=>'SearchComparesController@downloadOnlyForInquiries']);
            Route::get('/product/inquries/callme', ['as'=>'/product/inquries/callme','uses'=>'SearchComparesController@callMeOnlyForInquiries']);
            Route::delete('/product/inquries/{id}', ['as'=>'/product/inquries/{id}','uses'=>'SearchComparesController@deleteviewdownloadreport']);


            // ROUTE FOR INSTITUTIONUPLOADS CONTROLLER
            Route::resource('/institution/uploads', 'ProductUploadsController');
            Route::post('/search-loantype', ['as'=>'search-loantype','uses'=>'ProductUploadsController@search_by_loanType']);
            Route::post('/search-institutiontype', ['as'=>'search-institutiontype','uses'=>'ProductUploadsController@search_by_institutionType']);
            Route::post('/search-durationtype', ['as'=>'search-durationtype','uses'=>'ProductUploadsController@search_by_durationType']);
            Route::post('/institution/uploads', 'ProductUploadsController@store');

            // ROUTE FOR COMPARESCONTROLLER
            Route::resource('/total/compare/loans', 'ComparesController');

            // ROUTE FOR INSTITUTIONTYPESCONTROLLER
            Route::resource('/institution/types', 'InstitutionTypesController');

            // ROUTE FOR LOANTYPESCONTROLLER
            Route::resource('/loan/types', 'LoanTypesController');

            // ROUTES FOR PERMISSIONS
            // Call entrust users view
            Route::get('/settings/manage_users/permissions/entrust_user', 'PermissionsController@entrust_user');
            // Get all permissions for specific user
            Route::get('/settings/manage_users/permissions/entrust', 'PermissionsController@entrust');
            // Entrust user route
            Route::post('/settings/manage_users/permissions/entrust_usr', 'PermissionsController@entrust_user_permissions');
            // Get permission for role
            Route::get('/settings/manage_users/permissions/entrustRole', 'PermissionsController@entrust_roles');
            // Route to entrust permissions to the role
            Route::post('/settings/manage_users/permissions/entrust_role_permissions', 'PermissionsController@entrust_role_permissions');
            // Call roles view
            Route::get('/settings/manage_users/permissions/entrust_role', 'PermissionsController@entrust_role');
            Route::resource('/settings/manage_users/permissions/', 'PermissionsController');

            // ROUTES FOR ROLES
            Route::get('/settings/manage_users/roles/entrust', 'RolesController@get_roles');
            Route::post('/settings/manage_users/roles/entrust', 'RolesController@post_roles');
            Route::get('/settings/manage_users/roles/add', 'RolesController@add');
            Route::resource('/settings/manage_users/roles', 'RolesController');
        });
    });
});
        Route::post('/subscriber-email','SubscriberController@store');

