<?php
Route::group(['middleware' => ['web']], function () {
  Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home']);

  Route::get('testmail', 'MailsController@sendMail');
  Route::get('login', 'Auth\AuthController@showLoginForm');
  Route::post('login', 'Auth\AuthController@login');
  Route::get('logout', 'Auth\AuthController@logout');

  // Registration Routes...
  Route::get('register', 'RegistrationsController@showRegistrationForm');
  Route::post('register', ['as' => 'user.register' , 'uses' => 'RegistrationsController@register'] );
  Route::get('/activate/{token}', ['as' => 'user.activate', 'uses' => 'RegistrationsController@activateUser']);

  // Password Reset Routes...
  Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
  Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
  Route::post('password/reset', 'Auth\PasswordController@reset');

  Route::get('/all', 'ConferencesController@all');

  //Test Post Fail
  Route::get('/test/{confUrl}/add', ['as' => 'test.addPaper', 'uses' => 'UsersHomeController@addPaper']);
  Route::post('/test/{confUrl}/submit', ['as' => 'test.addPaper.submit', 'uses' => 'UsersHomeController@submitPaper']);

  //Administrator::Conferences
  Route::get('/admin', ['as' => 'admin', 'uses' => 'AdminsController@index']);
  Route::get('/admin/conferences', ['as' => 'admin.conf.all', 'uses' => 'AdminsController@showAllConferences']);
  Route::post('/admin/conferences', ['as' => 'admin.conf.post', 'uses' => 'AdminsController@storeNewConference']);
  Route::post('/admin/conferences/{confUrl}', ['as' => 'admin.conf.update', 'uses' => 'AdminsController@updateConference']);

  Route::get('/admin/conferences/new', ['as' => 'admin.conf.new', 'uses' => 'AdminsController@showNewConferenceForm']);
  Route::get('/admin/conferences/{confUrl}', ['as' => 'admin.conf.show', 'uses' => 'AdminsController@showSingleConference']);

  //Admin Users
  Route::get('/admin/users/new', ['as' => 'admin.user.new', 'uses' => 'AdminsUserController@showNewUserForm']);
  Route::post('/admin/users/register', ['as' => 'admin.user.register', 'uses' => 'AdminsUserController@registerUser']);
  Route::post('/admin/users', ['as' => 'admin.user.refresh', 'uses' => 'AdminsUserController@refreshUsers']);
  Route::get('/admin/users/all', ['as' => 'admin.user.all', 'uses' => 'AdminsUserController@showAllUsers']);
  Route::get('/admin/users/manage/{confUrl}', ['as' => 'admin.user.conf', 'uses' => 'AdminsUserController@showConferenceUsers']);
  Route::get('/admin/users/{userId}/', ['as' => 'admin.user.show', 'uses' => 'AdminsUserController@showSingleUser']);
  Route::get('/admin/users/{userId}/edit', ['as' => 'admin.user.edit', 'uses' => 'AdminsUserController@editUser']);
  Route::post('/admin/users/{userId}/edit', ['as' => 'admin.user.update', 'uses' => 'AdminsUserController@updateUser']);
  Route::get('/admin/users/{userId}/delete', ['as' => 'admin.user.delete', 'uses' => 'AdminsUserController@softDeleteUser']);

  // Users Home
  Route::get('/users/join/{confUrl}', ['as' => 'user.join.conf', 'uses' => 'UsersHomeController@join']);
  Route::post('/users/home/manage/{confUrl}/{paperId}/add-author', ['as' => 'user.home.single.addAuthor', 'uses' => 'UsersHomeController@addAuthor']);
  Route::get('/users/home/manage/{confUrl}/{paperId}/change/{authorId}', ['as' => 'user.home.single.changeContact', 'uses' => 'UsersHomeController@changeContact']);
  Route::get('/users/home/manage/{confUrl}/{paperId}/remove/{authorId}', ['as' => 'user.home.single.removeAuthor', 'uses' => 'UsersHomeController@removeAuthor']);
  Route::get('/users/home/manage/{confUrl}/{paperId}/edit/{authorId}', ['as' => 'user.home.single.editAuthor', 'uses' => 'UsersHomeController@editAuthor']);
  Route::post('/users/home/manage/{confUrl}/{paperId}/update/{authorId}', ['as' => 'user.home.single.updateAuthor', 'uses' => 'UsersHomeController@updateAuthor']);
  Route::post('/users/home/manage/{confUrl}/submit', ['as' => 'user.home.addPaper.submit', 'uses' => 'UsersHomeController@submitPaper']);
  Route::get('/users/home', ['as' => 'user.home.index', 'uses' => 'UsersHomeController@index']);
  Route::get('/users/home/manage/{confUrl}', ['as' => 'user.home.manage', 'uses' => 'UsersHomeController@manage']);
  Route::get('/users/home/manage/{confUrl}/add', ['as' => 'user.home.addPaper', 'uses' => 'UsersHomeController@addPaper']);
  Route::get('/users/home/manage/{confUrl}/{paperId}', ['as' => 'user.home.single.show', 'uses' => 'UsersHomeController@showSinglePaper']);
  Route::get('/users/home/manage/{confUrl}/{paperId}/move-author/{from}/{to}', ['as' => 'user.home.moveAuthor', 'uses' => 'UsersHomeController@moveAuthor']);
  Route::get('/users/home/manage/{confUrl}/{paperId}/cancel', ['as' => 'user.home.cancelpaper', 'uses' => 'UsersHomeController@cancelPaper']);

  //User Profile
  Route::get('/users/{userId}/profile', ['as' => 'user.profile', 'uses' => 'UsersHomeController@showProfile']);
  Route::get('/users/{userId}/edit', ['as' => 'user.profile.edit', 'uses' => 'UsersHomeController@editProfile']);
  Route::post('/users/{userId}/update', ['as' => 'user.profile.update', 'uses' => 'UsersHomeController@updateProfile']);

  // Conferences
  Route::get('/{confUrl}', 'HomepageController@home');
  Route::get('/{confUrl}/callpaper', 'HomepageController@callPaper');
  Route::get('/{confUrl}/policies', 'HomepageController@policies');

  /*================
  Organizer Section
  ==================*/
  Route::get('/{confUrl}/organizer/', ['as' => 'organizer.manage', 'uses' => 'OrgHomeController@dashboard']);

  //Enroll User
  Route::get('/{confUrl}/org/users/{mode?}', ['as' => 'organizer.allUser', 'uses' => 'OrgHomeController@showManagesUser']);
  Route::get('/{confUrl}/org/users/{user}/det/{mode}', ['as' => 'organizer.detachroles', 'uses' => 'OrgHomeController@detachRoles']);
  Route::get('/{confUrl}/org/users/{user}/att/{mode}', ['as' => 'organizer.attachroles', 'uses' => 'OrgHomeController@attachRoles']);

  //Register User
  Route::get('/{confUrl}/org/users/add', ['as' => 'organizer.addUser', 'uses' => 'OrgHomeController@showAddUser']);
  Route::post('/{confUrl}/org/users/add', ['as' => 'organizer.registerUser', 'uses' => 'OrgHomeController@registerUser']);
  Route::get('/{confUrl}/org/user/{userId}/edit', ['as' => 'organizer.editUser', 'uses' => 'OrgHomeController@showEditUser']);
  Route::post('/{confUrl}/org/users/{userId}/edit', ['as' => 'organizer.updateUser', 'uses' => 'OrgHomeController@updateUser']);

  //Manage Papers
  Route::get('/{confUrl}/org/papers/', ['as' => 'organizer.allPapers', 'uses' => 'OrgPaperController@allPapers']);
  Route::get('/{confUrl}/org/papers/{paperId}', ['as' => 'organizer.paper.showSingle', 'uses' => 'OrgPaperController@singlePaper']);
  Route::get('/{confUrl}/org/papers/{paperId}/assign', ['as' => 'organizer.paper.assignReviewer', 'uses' => 'OrgPaperController@assignReviewer']);
  Route::get('/{confUrl}/org/papers/{paperId}/att/{userId}', ['as' => 'organizer.paper.attachReviewer', 'uses' => 'OrgPaperController@attachReviewer']);
  Route::get('/{confUrl}/org/papers/{paperId}/dett/{userId}', ['as' => 'organizer.paper.detachReviewer', 'uses' => 'OrgPaperController@detachReviewer']);
  // Route::post('/{confUrl}/org/users/add', ['as' => 'organizer.registerUser', 'uses' => 'OrgHomeController@registerUser']);
  // Route::get('/{confUrl}/org/user/{userId}/edit', ['as' => 'organizer.editUser', 'uses' => 'OrgHomeController@showEditUser']);
  // Route::post('/{confUrl}/org/users/{userId}/edit', ['as' => 'organizer.updateUser', 'uses' => 'OrgHomeController@updateUser']);

});
