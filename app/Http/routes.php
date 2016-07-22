<?php
Route::group(['middleware' => ['web']], function () {
  Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);

  Route::get('testmail', 'MailsController@sendMail');
  Route::get('login', 'Auth\AuthController@showLoginForm');
  Route::post('login', 'Auth\AuthController@login');
  Route::get('logout', 'Auth\AuthController@logout');

  // Registration Routes...
  Route::get('register', 'RegistrationsController@showRegistrationForm');
  Route::post('register', 'RegistrationsController@register');
  Route::get('/activate/{token}', ['as' => 'user.activate', 'uses' => 'RegistrationsController@activateUser']);

  // Password Reset Routes...
  Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
  Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
  Route::post('password/reset', 'Auth\PasswordController@reset');

  Route::get('/all', 'ConferencesController@all');

  //Administrator::Conferences
  Route::get('/admin', ['as' => 'admin', 'uses' => 'AdminsController@index']);
  Route::get('/admin/conferences', ['as' => 'admin.conf.all', 'uses' => 'AdminsController@showAllConferences']);
  Route::post('/admin/conferences', ['as' => 'admin.conf.post', 'uses' => 'AdminsController@storeNewConference']);
  Route::post('/admin/conferences/{confUrl}', ['as' => 'admin.conf.update', 'uses' => 'AdminsController@updateConference']);

  Route::get('/admin/conferences/new', ['as' => 'admin.conf.new', 'uses' => 'AdminsController@showNewConferenceForm']);
  Route::get('/admin/conferences/{confUrl}', ['as' => 'admin.conf.show', 'uses' => 'AdminsController@showSingleConference']);

  //Users
  Route::get('/admin/users', ['as' => 'admin.user.all', 'uses' => 'AdminsUserController@showAllUsers']);

  // Conferences
  Route::get('/{confUrl}', 'HomepageController@home');
  Route::get('/{confUrl}/callpaper', 'HomepageController@callPaper');
  Route::get('/{confUrl}/policies', 'HomepageController@policies');

  Route::get('/{confUrl}/dashboard', 'ConferencesController@dashboard');

  //Enroll User
  Route::get('/{confUrl}/adm/users', ['as' => 'enrolls', 'uses' => 'EnrollsController@showManagesUser']);
  Route::get('/{confUrl}/adm/users/{user}/det/{mode}', ['as' => 'enrolls.detachroles', 'uses' => 'EnrollsController@detachRoles']);
  Route::get('/{confUrl}/adm/users/{user}/att/{mode}', ['as' => 'enrolls.attachroles', 'uses' => 'EnrollsController@attachRoles']);


});
