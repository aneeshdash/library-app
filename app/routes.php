<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
/*****************************************     UserController     *****************************************************/
Route::get('/', 'UserController@home');
//control for search
Route::get('basic_search', ['as' => 'user_bsearch', 'uses' => 'UserController@bsearch']);
Route::post('basic_search', ['as' => 'validate_bsearch', 'uses' => 'UserController@basicsearch']);
Route::get('advanced_search', ['as' => 'user_advanced_search', 'uses' => 'UserController@showaform']);
Route::post('advanced_search', ['as' => 'validate_asearch', 'uses' => 'UserController@advancesearch']);


//control for mutual transfer
Route::get('books', array('as'=>'books','uses'=>'UserController@index'));
Route::post('books', array('as'=>'bookstransfer','uses'=>'UserController@transfer'));

//control for upvoting and suggestion
Route::get('new_additions', ['as' => 'user_new_additions', 'uses' => 'UserController@new_additions']);
Route::post('submitsuggestion', ['as' => 'submitsuggestion', 'uses' => 'UserController@submitsuggestion']);
Route::post('upvote', ['as' => 'upvote', 'uses' => 'UserController@upvote']);


//deletion and printing of logs in forms
Route::post('method/del', ['as' => 'del_log', 'uses' => 'UserController@del_log']);
Route::post('method/del_donate', ['as' => 'del_donate_log', 'uses' => 'UserController@del_donate_log']);
Route::get('method/print_donate/{value}', ['as' => 'printLog_donate', 'uses' => 'UserController@printLog_donate']);
Route::get('method/print/{log_id}', ['as' => 'printLog', 'uses' => 'UserController@printLog']);


Route::get('accounts', ['as' => 'user_accounts', 'uses' => 'UserController@accounts']);
Route::get('wish_list', ['as' => 'user_wish_list', 'uses' => 'UserController@wish_list']);
Route::get('queued_books', ['as' => 'user_queued_books', 'uses' => 'UserController@queued_books']);
Route::get('contacts', ['as' => 'user_contacts', 'uses' => 'UserController@contacts']);
Route::get('lost_book', ['as' => 'user_lost_book', 'uses' => 'UserController@lost_book']);
Route::get('donate_book', ['as' => 'user_donate_book', 'uses' => 'UserController@donate_book']);
Route::post('method/donate_book', ['as' => 'user_add_donate_book', 'uses' => 'UserController@add_donate_book']);
Route::post('method/lost_book', ['as' => 'user_add_lost_book', 'uses' => 'UserController@add_lost_book']);
Route::post('method/update', ['as' => 'update_form', 'uses' => 'UserController@update_form']);


Route::post('method/wish', ['as' => 'add_wish', 'uses' => 'UserController@add_wish']);
Route::get('login', ['as' => 'login', 'uses' => 'UserController@login']);
Route::post('login', ['as' => 'login', 'uses' => 'UserController@postlogin']);
Route::get('lock_screen', ['as' => 'lock_screen', 'uses' => 'UserController@lock_screen']);
Route::get('logout', ['as' => 'logout', 'uses' => 'UserController@logout']);
Route::post('add_wish', ['as' => 'add_wish', 'uses' => 'UserController@wish_list']);
Route::get('new_additions', ['as' => 'user_new_additions', 'uses' => 'UserController@new_additions']);

Route::get('new_arrivals', ['as' => 'new_arrivals', 'uses' => 'UserController@new_arrivals']);
Route::get('feedback', ['as' => 'feedback', 'uses' => 'UserController@feedback']);
Route::post('feedback', ['as' => 'feedback', 'uses' => 'UserController@postfeedback']);
/**********************************************************************************************************************/




Route::group(array('prefix' => 'func'), function() {
    Route::post('newadd', ['as' => 'func_newadd', 'uses' => 'HomeController@newadd']);
    /*AdminController*/
    Route::post('edit', ['as' => 'func_edit', 'uses' => 'HomeController@func_edit']);
    Route::post('new', ['as' => 'func_new', 'uses' => 'HomeController@func_add']);
    Route::post('delete', ['as' => 'func_del', 'uses' => 'HomeController@func_del']);
    Route::post('bookDetail', ['as' => 'func_book_detail', 'uses' => 'HomeController@book_detail']);
    Route::post('payFine', ['as' => 'func_pay_fine', 'uses' => 'HomeController@pay_fine']);
    Route::post('showBook', ['as' => 'func_show_book', 'uses' => 'HomeController@show_book']);
    Route::post('issueBook', ['as' => 'func_issue_book', 'uses' => 'HomeController@issue_book']);
    Route::post('lostBook', ['as' => 'func_lost_book', 'uses' => 'HomeController@lost_book']);
    Route::post('retBook', ['as' => 'func_ret_book', 'uses' => 'HomeController@ret_book']);
    Route::post('reissueBook', ['as' => 'func_reissue', 'uses' => 'HomeController@reissue_book']);
    Route::post('chkUser', ['as' => 'func_chk_user', 'uses' => 'HomeController@chk_user']);
    Route::post('update_lostbook', ['as' => 'func_update_lostbook', 'uses' => 'HomeController@update_lostbook']);
    Route::post('new_del', ['as' => 'func_new_del', 'uses' => 'HomeController@new_del']);
    Route::post('lost_book', ['as' => 'func_lost_book', 'uses' => 'HomeController@lost_book']);
    Route::post('updates', ['as' => 'func_updates', 'uses' => 'HomeController@updates']);

});


Route::api('v1', function () {
    Route::get('login', 'APIController@login');
});
Route::get('admin/login', ['as' => 'adminlogin', 'uses' => 'AdminController@login']);
Route::post('admin/login', ['as' => 'adminlogin', 'uses' => 'AdminController@postlogin']);
Route::group(array('before'=>'auth.admin', 'prefix' => 'admin'),function()
{
    Route::get('test', array('as' => 'test', 'uses' => 'AdminController@test'));
    Route::get('/', ['as' => 'adminhome', 'uses' => 'AdminController@land']);
    Route::get('logout', ['as' => 'adminlogout', 'uses' => 'AdminController@logout']);
    Route::get('update', ['as' => 'adminupdate', 'uses' => 'AdminController@update']);
    Route::get('lostbook', ['as' => 'adminlostbook', 'uses' => 'AdminController@lost']);
    Route::get('newadditions', ['as' => 'newadditions', 'uses' => 'AdminController@newadd']);
    Route::get('user', ['as' => 'adminuser', 'uses' => 'AdminController@userprofile']);
    Route::post('user', ['as' => 'adminuser', 'uses' => 'AdminController@postuserprofile']);
    Route::group(array('prefix' => 'tables'), function() {
        Route::get('users', ['as' => 'tabusers', 'uses' => 'AdminController@tabusers']);
        Route::get('books', ['as' => 'tabbooks', 'uses' => 'AdminController@tabbooks']);
        Route::get('lost', ['as' => 'tablost', 'uses' => 'AdminController@tablost']);
        Route::get('admins', ['as' => 'tabadmin', 'uses' => 'AdminController@tabadmin']);
        Route::get('newadd', ['as' => 'tabnewadd', 'uses' => 'AdminController@tabnewadd']);
        Route::get('cat', ['as' => 'tabcat', 'uses' => 'AdminController@tabcat']);
        Route::get('env', ['as' => 'tabenv', 'uses' => 'AdminController@tabenv']);
        Route::get('pub', ['as' => 'tabpub', 'uses' => 'AdminController@tabpub']);
        Route::get('rules', ['as' => 'tabrules', 'uses' => 'AdminController@tabrules']);
    });
});


