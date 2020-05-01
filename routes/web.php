<?php
Route::get('/', 'Admin\DashboardController@index');


// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('auth.register');
$this->post('register', 'Auth\RegisterController@register')->name('auth.register');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

Route::group(['middleware' => ['admin'], 'prefix' => '', 'as' => 'admin.'], function () {
    Route::get('/home', 'Admin\DashboardController@index');
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::post('user_hide', ['uses' => 'Admin\UsersController@hide', 'as' => 'user_hide']);
    Route::post('user_active', ['uses' => 'Admin\UsersController@active', 'as' => 'user_active']);
    Route::resource('teams', 'Admin\TeamsController');
    Route::get('team_members', ['uses' => 'Admin\TeamsController@teamMembers', 'as' => 'team_members']);
    Route::post('teams_mass_destroy', ['uses' => 'Admin\TeamsController@massDestroy', 'as' => 'teams.mass_destroy']);
    Route::get('team_members_edit', ['uses' => 'Admin\TeamsController@teamMembersEdit', 'as' => 'team_members_edit']);
    Route::post('team_members_update', ['uses' => 'Admin\TeamsController@teamMembersUpdate', 'as' => 'team_members_update']);
    Route::resource('payment_history', 'Admin\PaymentHistoryController');
    Route::get('payment_history_confirm', ['uses' => 'Admin\PaymentHistoryController@confirm', 'as' => 'payment_history.confirm']);
    Route::post('payment_history_confirm', ['uses' => 'Admin\PaymentHistoryController@confirmPost', 'as' => 'payment_history.confirm']);
    Route::get( 'userpayment/team', ['uses' => 'Admin\UserTeamPaymentController@team', 'as' => 'payment_history.team']);
    Route::resource('user_payment', 'Admin\UserPaymentController');
    Route::resource('payment_address', 'Admin\PaymentAddressController');
});
