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

// Route::get('/fundamentals', ['as' => 'fundamentals', function () {
// 	$project_id = 1;
//     $accidents = App\Accidents::where('project_id', $project_id)->get();
//     return view('pages.home', compact("accidents", "project_id"));
// }]);

Route::get('/', ['as' => 'home', function () {
	if (Auth::check()) {
        if (Auth::user()->name == "Celso Hirata")
		    $project_id = 2;
        else
            $project_id = 1;
    	$accidents = App\Accidents::where('project_id', $project_id)->get();
    	return view('pages.home', compact("accidents", "project_id"));
	}
    else
    	return view('home');
}]);

Route::get('/stepone', ['as' => 'stepone', function () {
	if (Auth::check()) {
		if (Auth::user()->name == "Celso Hirata")
            $project_id = 2;
        else
            $project_id = 1;
    	$accidents = App\Accidents::where('project_id', $project_id)->get();
    	return view('pages.stepone', compact("accidents", "project_id"));
	}
    else
    	return view('home');
}]);

Route::get('/steptwo', ['as' => 'steptwo', function () {
	if (Auth::user()->name == "Celso Hirata")
            $project_id = 2;
        else
            $project_id = 1;
    return view('pages.steptwo', compact("project_id"));
}]);


Route::get('/login', ['as' => 'login', function () {
    return view('auth.login');
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

Route::post('/adduca', 'SafetyConstraintsController@add');
Route::post('/edituca', 'SafetyConstraintsController@edit');
Route::post('/deleteuca', 'SafetyConstraintsController@delete');
// Route::post('/addsuggesteduca', 'SystemSafetyConstraintController@save');

Route::post('/addtuple', 'CausalAnalysisController@add');
Route::post('/edittuple', 'CausalAnalysisController@edit');
Route::post('/deletetuple', 'CausalAnalysisController@delete');


Route::post('/deleteaccidentassociated', 'AccidentHazardController@delete');

Route::post('/addrule', 'RuleController@add');
Route::post('/refreshPage', 'RuleController@refreshPage');
Route::post('/deleterule', 'RuleController@delete');

Route::post('/savecontexttable', 'ContextTableController@save');
Route::post('/deletecontexttable', 'ContextTableController@delete');
Route::post('/generateUCA', 'ContextTableController@generateUCA');

Route::auth();

Route::get('/home', 'HomeController@index');
