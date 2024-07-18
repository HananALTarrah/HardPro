
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



// الامتحانات الوطنية        OK
Route::get('/nationalexams',[NationalExamsController::class,'index']);//OK
Route::post('/nationalexams/store',[NationalExamsController::class,'store']);//OK
Route::delete('/nationalexams/delete/{id}',[NationalExamsController::class,'destroy']);//OK

// cookies

// أسئلة امتحانية          OK
  Route::get('/questions',[QuestionsController::class,'index']);//you don't need it
  Route::post('/questions/{test_id}',[QuestionsController::class,'store']);//OK
  Route::get('/questions/{id}', [QuestionsController::class, 'show']);//OK
  Route::post('/questions/update/{id}',[QuestionsController::class,'update']);//OK
  Route::delete('/questions/delete/{question}',[QuestionsController::class,'destroy']);//OK
  Route::get('/questions/{id}', [QuestionsController::class, 'show']);//OK
  Route::get('/tests/{test_id}', [QuestionsController::class, 'getQuestionsByTestId']);//OK
// مسار البحث عن الأسئلة بناءً على test_id و قيمة حقل question
Route::post('/questions/search/{test_id}', [QuestionsController::class, 'searchByQuestion']);//OK

  // الاختبارات             OK
  Route::get('/tests', [TestsController::class, 'index']);//OK
  Route::delete('/tests/delete/{id}', [TestsController::class, 'destroy']);//OK
  Route::post('/tests/store',[TestsController::class,'store']);//OK
