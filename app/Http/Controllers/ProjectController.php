<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Project;

use App\Team;

use App\User;

class ProjectController extends Controller
{
    
	public function add(Request $request){
		$project = new Project();
		$project->name = $request->input('name');
		$project->description = $request->input('description');
		$project->type = $request->input('type');
		$project->save();

		$url = $project->name . " " . $project->id;
		$project->URL = str_slug($url, '-');
		$project->save();

		$users = explode(";", $request->input('shared'));
		foreach($users as $user){
			$team = new Team();
			$getUserId = User::where('email', $user)->get();
			$team->user_id = 0;
			foreach($getUserId as $userid){
				$team->user_id = $userid->id;
			}
			$team->project_id = $project->id;
			$team->save();
		}

		return redirect(route('projects'));
	}

	public function delete(Request $request){
		Project::destroy($request->get('project_id'));

		$teams = Team::where("project_id", $request->get('project_id'))->get();
		foreach($teams as $team) {
			Team::destroy($team->id);
		}

		return redirect(route('projects'));
	}

	public function edit(Request $request){
		$project = Project::find($request->input('id'));
		$project->name = $request->input('name');
		$project->description = $request->input('description');
		$url = $project->name . " " . $project->id;
		$project->URL = str_slug($url, '-');
		$project->save();

		return redirect(route('projects'));
	}

}
