<?php
Route::resource('user.profile', 'UserProfileController');
Route::resource('cart', 'CartController');
Route::resource('transaction', 'TransactionController');
Route::resource('transaction.detail', 'TransactionDetailController');
Route::resource('transaction.vendor', 'TransactionVendorController');
Route::resource('transaction.vendor.detail', 'TransactionVendorDetailController');

Route::put('user.change.password', 'UserProfileController@change_password')->name('user.change.password');