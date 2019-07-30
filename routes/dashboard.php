<?php
Route::resource('yearly', 'Achievement\YearlyAchievementController');
Route::resource('monthly', 'Achievement\MonthlyAchievementController');
Route::resource('daily', 'Achievement\DailyAchievementController');
Route::get('daily/monthly/yearly/{id}', 'Achievement\DailyAchievementController@monthlyByYearly')->name('monthly.by.yearly');
Route::get('daily/monthly/{id}', 'Achievement\DailyAchievementController@dailyByMonthly')->name('daily.by.monthly');
Route::get('generate/yearly/{id}', 'Achievement\MonthlyAchievementController@generateByYearly')->name('generate.by.yearly');
Route::get('generate/monthly/{id}', 'Achievement\MonthlyAchievementController@generateByMonthly')->name('generate.by.monthly');
Route::post('monthly/save/generate/target', 'Achievement\MonthlyAchievementController@monthlySaveGenerateTarget')->name('monthly.save.generate.target');
Route::post('daily/save/generate/target', 'Achievement\DailyAchievementController@dailySaveGenerateTarget')->name('daily.save.generate.target');

/* Inbound */
Route::resource('inbound/daily-inbound', 'Inbound\DailyInboundController');
Route::resource('inbound/monthly-inbound', 'Inbound\MonthlyInboundController');
Route::resource('inbound/yearly-inbound', 'Inbound\YearlyInboundController');