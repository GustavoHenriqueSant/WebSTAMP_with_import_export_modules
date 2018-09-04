<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Team;

use App\User;

class TeamController extends Controller
{

    public function get(Request $request){
        $team = Team::where('project_id', $request->input("id"))->orderBy('id', 'asc')->get();
        $myTeam = array();
        foreach ($team as $t) {
            $users = User::where('id', $t->user_id)->orderBy('id', 'asc')->get();
            foreach ($users as $user) {
                array_push($myTeam, $user->email);
            }
        }

    	return response()->json([
        	'team' => $myTeam
    	]);

    }

}
