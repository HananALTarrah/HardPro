
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\TestsController;
use App\Http\Controllers\Admin\NationalExamsController;
use App\Http\Controllers\Admin\QuestionsController;
use App\Http\Controllers\Admin\NewPostController;

Route::get('/','DashboardController@index')->name('admin.dashboard');

Route::group(['namespace'=>'Admin','middelware'=>'guest:admin'],function(){
      Route::get('login',[LoginController::class,'getLogin'])->name('get.admin.login');
      Route::post('login',[LoginController::class,'login'])->name('admin.login');
});

//   الاختبارات
  Route::group(['prefix' => 'tests'], function () {
      Route::get('/',[TestsController::class,'index']) -> name('admin.tests');
      Route::get('create',[TestsController::class,'create']) -> name('admin.tests.create');
      // Route::post('store',[TestsController::class,'store']) -> name('admin.tests.store');
      Route::get('edit/{id}','TestsController@edit') -> name('admin.tests.edit');
      Route::post('update/{id}','TestsController@update') -> name('admin.tests.update');
      Route::get('delete/{id}','TestsController@destroy') -> name('admin.tests.delete');
  });
  Route::middleware('auth:admin')->group(function () {
    Route::post('/store', [TestController::class, 'store']);
});



// الامتحانات الوطنية
Route::group(['prefix' => 'nationalexams'], function () {
      Route::get('/','NationalExamsController@index') -> name('admin.nationalexams');
      Route::get('create','NationalExamsController@create') -> name('admin.nationalexams.create');
      Route::post('store','NationalExamsController@store') -> name('admin.nationalexams.store');
      Route::get('{nationalexam}', 'NationalExamsController@show') ->name('admin.nationalexams.show');
      Route::get('{nationalexam}/edit','NationalExamsController@edit') -> name('admin.nationalexams.edit');
      Route::put('{nationalexam}','NationalExamsController@update') -> name('admin.nationalexams.update');
      Route::delete('{nationalexam}','NationalExamsController@destroy') -> name('admin.nationalexams.destroy');
      Route::delete('{nationalexam}','NationalExamsController@forceDelete') -> name('admin.nationalexams.forceDelete');

  });


// أسئلة امتحانية
  Route::get('/questions',[QuestionsController::class,'index']);
  Route::post('/questions/store',[QuestionsController::class,'store']);
  Route::put('/questions/update/{question}',[QuestionsController::class,'update']);
  Route::delete('/questions/delete/{question}',[QuestionsController::class,'destroy']);
  Route::get('/questions/{id}', [QuestionsController::class, 'show']);
  Route::get('/tests/{test_id}', [QuestionsController::class, 'getQuestionsByTestId']);
  

  // الاختبارات
  Route::get('/tests', [TestsController::class, 'index']);
  Route::delete('/tests/delete/{id}', [TestsController::class, 'destroy']);
  Route::post('/tests/store',[TestsController::class,'store']);
