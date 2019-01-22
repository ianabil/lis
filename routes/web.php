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
   if(Auth::check())
      return redirect('/dashboard');
   else
      return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

      Route::get('/home', 'HomeController@index')->name('home');

      Route::get('dashboard', function () {
         return view('dashboard');
      });

      Route::get('search', 'SearchController@index');

      Route::post('search/search','SearchController@search');

      Route::post('search/search/issued_to','SearchController@issued_to');      

      Route::resource('books','BooksController');
      
      Route::get('entry_new_book','BooksController@get_data');

      Route::get('update_book','BooksController@get_data_for_update_book');

      Route::get('issue_books','IssueBookController@get_data_on_load');  
      
      Route::post('get_data_to_issue','IssueBookController@get_data_for_issue_book');

      Route::post('insert_to_issue_book','IssueBookController@insert_data_issue_book');

      Route::get('receipt_books', function () {
         return view('receipt_books');
      });

      Route::post('get_data_to_return','ReturnBookController@get_data_to_return_book'); 

      Route::post('update_receive_book_record','ReturnBookController@update_receive_book_record');
      
      Route::get('upload_catalogue', function () {
         return view('upload_catalogue');
      });


      Route::get('upload_koha_report', function () {
         return view('upload_koha_report');
      });

      Route::get('title_master_maintainance',function(){
          return view('title_master_maintainance');
      });

      Route::post('title_master_maintainance/store','TitleMasterMaintainanceController@store');

      Route::post('title_master_maintainance/update','TitleMasterMaintainanceController@update_title');

      Route::post('title_master_maintainance/delete','TitleMasterMaintainanceController@destroy');

      Route::post('show_all_title','TitleMasterMaintainanceController@get_all_title_data');

      Route::get('subject_master_maintainance', function(){
         return view('subject_master_maintainance');
      });
            
      Route::post('show_all_subject','SubjectMasterMaintainanceController@get_all_subject_data');
           
      Route::post('update_subject','SubjectMasterMaintainanceController@update_subj_table');
            
      Route::post('subjectentry','SubjectMasterMaintainanceController@insert_subject');
            
      Route::post('delete_subject','SubjectMasterMaintainanceController@delete_from_subj_table');


      Route::get('location_master_maintainance', function () {
         return view('location_master_maintainance');
      });

      Route::post('show_all_location','LocationMasterMaintenanceController@get_all_location_data');
            
      Route::post('insert_new_location','LocationMasterMaintenanceController@insert_new_location');
            
      Route::post('location_master_maintainance/update','LocationMasterMaintenanceController@update_location');
            
      Route::post('location_master_maintainance/delete','LocationMasterMaintenanceController@destroy');

      Route::get('publisher_master_maintainance', function () {
         return view('publisher_master_maintainance');
      });

      Route::post('show_all_publisher','PublisherMasterMaintainanceController@get_all_publisher_data');

      Route::post('publisher_master_maintainance/store','PublisherMasterMaintainanceController@store');

      Route::post('publisher_master_maintainance/update','PublisherMasterMaintainanceController@update_publisher');

      Route::post('publisher_master_maintainance/delete','PublisherMasterMaintainanceController@destroy');

      Route::get('member_master_maintenance', function () {
         return view('member_master_maintenance');
      });

      Route::post('show_all_member','MemberMasterMaintenanceController@get_all_member_data');

      Route::post('insert_new_member','MemberMasterMaintenanceController@insert_new_member');

      Route::post('member_master_maintainance/update','MemberMasterMaintenanceController@update_member');

      Route::post('member_master_maintainance/delete','MemberMasterMaintenanceController@destroy');

      Route::get('marked_for_discarded_book','DiscardBookManagementController@get_data');

      Route::post('get_book_data','DiscardBookManagementController@get_book_data_to_discard');
      
      Route::post('update_book_to_discard','DiscardBookManagementController@update_book_to_discard');

      Route::get('user_master_maintenance','UserMasterMaintenanceController@get_data');

      Route::post('user_master_maintenance','UserMasterMaintenanceController@store');

      Route::get('edit_login_user_details','UserMasterMaintenanceController@update_login_user_details');

      Route::post('edit_login_user_details/get_data','UserMasterMaintenanceController@get_data_of_selected_user');
            
      Route::get('update_password/update','UpdatePasswordController@check');      
      
      Route::get('update_password', function () {
         return view('update_password');
      });

});

