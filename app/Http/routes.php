<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'fundamentals', function () {
    $accidents = App\Accidents::all();
    $variables = App\Variable::all();
    $components = App\Components::all();
    return view('pages.index', compact("accidents", "variables", "components"));
}]);
Route::post('/addaccident', 'AccidentController@add');
Route::post('/deleteaccident', 'AccidentController@delete');
Route::post('/addcomponent', 'ComponentController@add');
Route::post('/addcontrolaction', 'ControlActionController@add');
Route::post('/addhazard', 'HazardController@add');
Route::post('/addsystemgoal', 'SystemGoalController@add');
Route::post('/addvariable', 'VariableController@add');
Route::post('/addstate', 'StateController@add');
Route::get('/stepone', ['as' => 'stepone', function () {
    return view('pages.stepone');
}]);