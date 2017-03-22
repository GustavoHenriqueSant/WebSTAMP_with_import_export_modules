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
	$project_id = 1;
    $accidents = App\Accidents::where('project_id', $project_id)->get();
    return view('pages.index', compact("accidents", "project_id"));
}]);

Route::post('/addsystemgoal', 'SystemGoalController@add');
Route::post('/editsystemgoal', 'SystemGoalController@edit');
Route::post('/deletesystemgoal', 'SystemGoalController@delete');

Route::post('/addaccident', 'AccidentController@add');
Route::post('/editaccident', 'AccidentController@edit');
Route::post('/deleteaccident', 'AccidentController@delete');

Route::post('/addactuator', 'ActuatorController@add');
Route::post('/editactuator', 'ActuatorController@edit');
Route::post('/deleteactuator', 'ActuatorController@delete');

Route::post('/addcontroller', 'ControllerController@add');
Route::post('/editcontroller', 'ControllerController@edit');
Route::post('/deletecontroller', 'ControllerController@delete');

Route::post('/addcontrolledprocess', 'ControlledProcessController@add');
Route::post('/editcontrolledprocess', 'ControlledProcessController@edit');
Route::post('/deletecontrolledprocess', 'ControlledProcessController@delete');

Route::post('/addsensor', 'SensorController@add');
Route::post('/editsensor', 'SensorController@edit');
Route::post('/deletesensor', 'SensorController@delete');

Route::post('/addcontrolaction', 'ControlActionController@add');
Route::post('/editcontrolaction', 'ControlActionController@edit');
Route::post('/deletecontrolaction', 'ControlActionController@delete');

Route::post('/addhazard', 'HazardController@add');
Route::post('/edithazard', 'HazardController@edit');
Route::post('/deletehazard', 'HazardController@delete');

Route::post('/addvariable', 'VariableController@add');
Route::post('/editvariable', 'VariableController@edit');
Route::post('/deletevariable', 'VariableController@delete');

Route::post('/addsystemsafetyconstraint', 'SystemSafetyConstraintController@add');
Route::post('/editsystemsafetyconstraint', 'SystemSafetyConstraintController@edit');
Route::post('/deletesystemsafetyconstraint', 'SystemSafetyConstraintController@delete');

Route::post('/addconnections', 'ConnectionController@add');
Route::post('/deleteconnections', 'ConnectionController@delete');

Route::post('/addstate', 'StateController@add');
Route::post('/deletestate', 'StateController@delete');


Route::post('/deleteaccidentassociated', 'AccidentHazardController@delete');

Route::post('/addrule', 'RuleController@add');
Route::post('/refreshPage', 'RuleController@refreshPage');
Route::post('/deleterule', 'RuleController@delete');

Route::get('/stepone', ['as' => 'stepone', function () {
    return view('pages.stepone');
}]);

Route::get('/steptwo', ['as' => 'steptwo', function () {
    return view('pages.steptwo');
}]);

Route::post('/savecontexttable', 'ContextTableController@save');