<?php
Route::resource('yearly', 'YearlyAchievementController');
Route::resource('monthly', 'MonthlyAchievementController');
Route::resource('daily', 'DailyAchievementController');
// Route::resource('blog', 'BlogController');
// Route::resource('carregion', 'CarRegionController');
// Route::resource('carbrand', 'CarBrandController');
// Route::resource('cartype', 'CarTypeController');
// Route::resource('carmodel', 'CarModelController');
// Route::resource('caryear', 'CarYearController');
// Route::resource('flatrate', 'FlatRateController');
// Route::resource('assurancetype', 'AssuranceTypeController');
// Route::resource('assurancerate', 'AssuranceRateController');
Route::get('daily/monthly/yearly/{id}', 'DailyAchievementController@monthlyByYearly')->name('monthly.by.yearly');
Route::get('daily/monthly/{id}', 'DailyAchievementController@dailyByMonthly')->name('daily.by.monthly');
Route::get('generate/yearly/{id}', 'MonthlyAchievementController@generateByYearly')->name('generate.by.yearly');
Route::get('generate/monthly/{id}', 'MonthlyAchievementController@generateByMonthly')->name('generate.by.monthly');
Route::post('monthly/save/generate/target', 'MonthlyAchievementController@monthlySaveGenerateTarget')->name('monthly.save.generate.target');
Route::post('daily/save/generate/target', 'DailyAchievementController@dailySaveGenerateTarget')->name('daily.save.generate.target');