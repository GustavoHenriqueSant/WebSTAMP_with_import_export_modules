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

Route::post('/addsystemgoal', 'SystemGoalController@add');
Route::post('/editsystemgoal', 'SystemGoalController@edit');
Route::post('/deletesystemgoal', 'SystemGoalController@delete');

Route::post('/addaccident', 'AccidentController@add');
Route::post('/editaccident', 'AccidentController@edit');
Route::post('/deleteaccident', 'AccidentController@delete');

Route::post('/addcomponent', 'ComponentController@add');
Route::post('/editcomponent', 'ComponentController@edit');
Route::post('/deletecomponent', 'ComponentController@delete');

Route::post('/addcontrolaction', 'ControlActionController@add');
Route::post('/editcontrolaction', 'ControlActionController@edit');
Route::post('/deletecontrolaction', 'ControlActionController@delete');

Route::post('/addhazard', 'HazardController@add');
Route::post('/edithazard', 'HazardController@edit');
Route::post('/deletehazard', 'HazardController@delete');

Route::post('/addvariable', 'VariableController@add');
Route::post('/editvariable', 'VariableController@edit');
Route::post('/deletevariable', 'VariableController@delete');

Route::post('/addstate', 'StateController@add');
Route::post('/deletestate', 'StateController@delete');

Route::post('/addsystemsafetyconstraint', 'SystemSafetyConstraintController@add');
Route::post('/editsystemsafetyconstraint', 'SystemSafetyConstraintController@edit');
Route::post('/deletesystemsafetyconstraint', 'SystemSafetyConstraintController@delete');

Route::post('/deleteaccidentassociated', 'AccidentHazardController@delete');

Route::post('/addrule', 'RuleController@add');

Route::get('/stepone', ['as' => 'stepone', function () {
    return view('pages.stepone');
}]);