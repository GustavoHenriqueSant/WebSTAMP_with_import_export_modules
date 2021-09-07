<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JsonSchema\Validator;
use App\Http\Requests;

use App\Project;
use App\Actuators;
use App\Assumptions;
use App\CausalAnalysis;
use App\Components;
use App\ContextTable;
use App\ControlAction;
use App\ControlledProcess;
use App\Controllers;
use App\Hazards;
use App\Losses;
use App\LossesHazards;
use App\Rule;
use App\RulesVariablesStates;
use App\SafetyConstraints;
use App\Variable;
use App\State;
use App\Sensors;
use App\SystemGoals;
use App\SystemSafetyConstraintHazards;
use App\SystemSafetyConstraints;
use App\Connections;

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

	public function import(Request $request){
		/*
		//Instanciando vetores auxiliares => array(['id_armazenado_WEBstamp', 'id_no_JSON']);
		$map_id_rules = array();
		$map_id_losses = array();
		$map_id_hazards = array();
		$map_id_variables = array();
		$map_id_states = array();
		$map_id_actuators = array();
		$map_id_controllers = array();
		$map_id_controlledProcess = array();
		$map_id_sensors = array();*/

		//Lendo arquivo de importação e transformando em um array.
		$json = file_get_contents($request->file("import"));
		$arrayJSON = json_decode($json);

		$schema = json_decode(file_get_contents(__DIR__ . "/WebSTAMP_JSON_Schema.json"));
		$validator = new Validator();
		$validator->validate($arrayJSON, $schema);

		if($validator->isValid()){
			echo "O documente é valido, AEEEEEEEE";
		} else {
			echo "Documento não é válido n menor afffffffff <br>";
			echo "<ul>";
			foreach($validator->getErrors() as $error){
				echo "<li>" . sprintf("[%s] %s", $error['property'], $error['message']) . "</li>";
			}
			echo "</ul>";
		}

		/*
		//Criando novo projeto:
		$projeto = new Project();
		$projeto->name = $arrayJSON['name'];
		$projeto->description = $arrayJSON['description'];
		$projeto->type = $arrayJSON['type'];
		$projeto->save();
		//Setabdo nome de URL única
		$url = $projeto->name . " " . $projeto->id;
		$projeto->URL = str_slug($url, '-');
		$projeto->save();
		//Setando id de usuário envolvido com o projeto importado
		$team = new Team();
		$team->user_id = $request->user()->id;
		$team->project_id = $projeto->id;
		$team->save();

		//Salvando os actuators
		foreach($arrayJSON['actuators'] as $atuador){
			$actuator = new Actuators();
			$actuator->name = $atuador['name'];
			$actuator->project_id = $projeto->id;
			$actuator->save();
			$map_id_actuators[] = array($actuator->id, $atuador['id']);
		}

		//Salvando as assumptions
		foreach($arrayJSON['assumptions'] as $premissa){
			$assumption = new Assumptions();
			$assumption->name = $premissa['name'];
			$assumption->description = $premissa['description'];
			$assumption->project_id = $projeto->id;
			$assumption->save();
		}

		//Salvando Controlled Process
		$controlled = new ControlledProcess();
		$controlled->name = $arrayJSON['controlled_process']['name'];
		$controlled->project_id = $projeto->id;
		$controlled->save();
		$map_id_controlledProcess[] = array($controlled->id, $arrayJSON['controlled_process']['id']);

		//Salvando controllers
		foreach($arrayJSON['controllers'] as $controlador){
			$controller = new Controllers();
			$controller->name = $controlador['name'];
			$controller->type = $controlador['type'];
			$controller->project_id = $projeto->id;
			$controller->save();
			$map_id_controllers[] = array($controller->id, $controlador['id']);
			//Salvando Variáveis
			foreach($controlador['variables'] as $variavel){
				$variable = new Variable();
				$variable->name = $variavel['name'];
				$variable->project_id = $projeto->id;
				if($variavel['controller_id'] === 0){
					$variable->controller_id = 0;
				} else {
					$variable->controller_id = $controller->id;
				}
				$variable->save();
				$map_id_variables[] = array($variable->id, $variavel['id']);
				//Salvando estados
				foreach($variavel['state'] as $estado){
					$state = new State();
					$state->name = $estado['name'];
					$state->variable_id = $variable->id;
					$state->save();
					$map_id_states[] = array($state->id, $estado['id']);
				}
			}
			//Salvando control actions de um Controller
			foreach($controlador['controlaction'] as $acoes){
				$control = new ControlAction();
				$control->name = $acoes['name'];
				$control->description = $acoes['description'];
				$control->controller_id = $controller->id;
				$control->save();
				//Salvando as regras de uma control action
				foreach($acoes['rules'] as $regra){
					$rule = new Rule();
					$rule->controlaction_id = $control->id;
					$rule->column = $regra['column'];
					$rule->save();
					$map_id_rules[] = array($rule->id, $regra['id']);
					//Salavando a relação state, variable and rule
					$relacao_variable_state = new RulesVariablesStates();
					$relacao_variable_state->rule_id = $rule->id;
					foreach($map_id_variables as $aux){
						if($aux[1] === $regra['variable_state']['variable_id']){
							$relacao_variable_state->variable_id = $aux[0];
							break;
						}
					}
					foreach($map_id_states as $aux){
						if($aux[1] === $regra['variable_state']['state_id']){
							$relacao_variable_state->state_id = $aux[0];
							break;
						}
					}
					$relacao_variable_state->save();
				}
				//Salvando a context table
				foreach($acoes['context_table'] as $tabela){
					$table = new ContextTable();
					$table->controlaction_id = $control->id;
					$table->context = $tabela['context'];
					$table->ca_provided = $tabela['ca_provided'];
					$table->ca_not_provided = $tabela['ca_not_provided'];
					$table->wrong_time_order = $tabela['wrong_time_order'];
					$table->ca_too_early = $tabela['ca_too_early'];
					$table->ca_too_late = $tabela['ca_too_late'];
					$table->ca_too_soon = $tabela['ca_too_soon'];
					$table->ca_too_long = $tabela['ca_too_long'];
					$table->save();
				}
				//Salvando as safety constraints
				foreach($acoes['safety_constraint'] as $restricao){
					$safety = new SafetyConstraints();
					$safety->unsafe_control_action = $restricao['unsafe_control_action'];
					$safety->safety_constraint = $restricao['safety_constraint'];
					$safety->type = $restricao['type'];
					$safety->context = $restricao['context'];
					$safety->controlaction_id = $control->id;
					foreach($map_id_rules as $key => $id_rule){
						if($id_rule[1] === $restricao['rule_id']){
							$safety->rule_id = $id_rule[0];
						}
					}
					$safety->flag = $restricao['flag'];
					$safety->save();
					foreach($restricao['causal_analysis'] as $analise){
						$analysis = new CausalAnalysis();
						$analysis->scenario = $analise['scenario'];
						$analysis->associated_causal_factor = $analise['associated_causal_factor'];
						$analysis->requirement = $analise['requirement'];
						$analysis->role = $analise['role'];
						$analysis->rationale = $analise['rationale'];
						$analysis->guideword_id = $analise['guideword_id'];
						$analysis->safety_constraint_id = $safety->id;
						$analysis->save();
					}
				}
			}
			
		}
		//Salvando as losses
		foreach($arrayJSON['losses'] as $perda){
			$losse = new Losses();
			$losse->name = $perda['name'];
			$losse->description = $perda['description'];
			$losse->project_id = $projeto->id;
			$losse->save();
			$map_id_losses[] = array($losse->id, $perda['id']);
		}

		//Salvando os hazards
		foreach($arrayJSON['hazards'] as $perigo){
			$hazard = new Hazards();
			$hazard->name = $perigo['name'];
			$hazard->description = $perigo['description'];
			$hazard->project_id = $projeto->id;
			$hazard->save();
			$map_id_hazards[] = array($hazard->id, $perigo['id']);
			foreach($perigo['losseshazards'] as $lh){
				$loha = new LossesHazards();
				$loha->hazard_id = $hazard->id;
				foreach($map_id_losses as $aux){
					if($aux[1] === $lh['loss_id']){
						$loha->loss_id = $aux[0];
						break;
					}
				}
				$loha->save();
			}
		}

		//Salvando sensor
		foreach($arrayJSON['sensor'] as $sensore){
			$sensor = new Sensors();
			$sensor->name = $sensore['name'];
			$sensor->project_id = $projeto->id;
			$sensor->save();
			$map_id_sensors[] = array($sensor->id, $sensore['id']);
		}

		//Salvando system goals
		foreach($arrayJSON['system_goals'] as $objetivo){
			$goal = new SystemGoals();
			$goal->name = $objetivo['name'];
			$goal->description = $objetivo['description'];
			$goal->project_id = $projeto->id;
			$goal->save();
		}

		//Salvando ssc
		foreach($arrayJSON['ssc'] as $restricaoSistema){
			$ssc = new SystemSafetyConstraints();
			$ssc->name = $restricaoSistema['name'];
			$ssc->description = $restricaoSistema['description'];
			$ssc->project_id = $projeto->id;
			$ssc->save();
			foreach($restricaoSistema['system_safety_constraint_hazards'] as $sschs){
				$ssch = new SystemSafetyConstraintHazards();
				$ssch->ssc_id = $ssc->id;
				foreach($map_id_hazards as $aux){
					if($aux[1] === $sschs['hazard_id']){
						$ssch->hazard_id = $aux[0];
						break;
					}
				}
				$ssch->save();
			}
		}
		
		//Salvando as conexoes
		foreach($arrayJSON['connections'] as $conexao){
			$conection = new Connections();
			$conection->type_output = $conexao['type_output'];
			$conection->type_input = $conexao['type_input'];
			switch($conexao['type_output']){
				case "controller":
					foreach($map_id_controllers as $auxI){
						if($conexao['output_component_id'] === $auxI[1]){
							$conection->output_component_id = $auxI[0];
							break;
						}
					}
					break;
				case "actuator":
					foreach($map_id_actuators as $auxI){
						if($conexao['output_component_id'] === $auxI[1]){
							$conection->output_component_id = $auxI[0];
							break;
						}
					}
					break;
				case "controlled_process":
					foreach($map_id_controlledProcess as $auxI){
						if($conexao['output_component_id'] === $auxI[1]){
							$conection->output_component_id = $auxI[0];
							break;
						}
					}
					break;
				case "sensor":
					foreach($map_id_sensors as $auxI){
						if($conexao['output_component_id'] === $auxI[1]){
							$conection->output_component_id = $auxI[0];
							break;
						}
					}
					break;
			}
			switch($conexao['type_input']){
				case "controller":
					foreach($map_id_controllers as $auxI){
						if($conexao['input_component_id'] === $auxI[1]){
							$conection->input_component_id = $auxI[0];
							break;
						}
					}
					break;
				case "actuator":
					foreach($map_id_actuators as $auxI){
						if($conexao['input_component_id'] === $auxI[1]){
							$conection->input_component_id = $auxI[0];
							break;
						}
					}
					break;
				case "controlled_process":
					foreach($map_id_controlledProcess as $auxI){
						if($conexao['input_component_id'] === $auxI[1]){
							$conection->input_component_id = $auxI[0];
							break;
						}
					}
					break;
				case "sensor":
					foreach($map_id_sensors as $auxI){
						if($conexao['input_component_id'] === $auxI[1]){
							$conection->input_component_id = $auxI[0];
							break;
						}
					}
					break;
			}
			$conection->save();
		}


		return redirect(route('projects'));*/
	}

	public function export(Request $request){
		$project = Project::where('id',  $request->get('project_id'))->
							with("actuators", "assumptions", "controlledProcess", "controllers",
								"controllers.controlaction", "controllers.controlaction.rules", "controllers.controlaction.rules.variableState",
								"controllers.controlaction.contextTable",
								"controllers.controlaction.safetyConstraint", "controllers.controlaction.safetyConstraint.causalAnalysis",
								"controllers.controlaction.safetyConstraint.rulesSafetyConstraintsHazards", "hazards", "hazards.losseshazards",
								"losses", "missions", "sensor", "systemGoals", "ssc", "ssc.systemSafetyConstraintHazards")->first();


		$vetorAux = array();
		foreach(Connections::All() as $conexao){
			foreach($project['actuators'] as $atuador){
				if($atuador['id'] === $conexao['output_component_id'] && $conexao['type_output'] === 'actuator'){
					$vetorAux[] = $conexao;
				}
			}
			foreach($project['controllers'] as $controller){
				if($controller['id'] === $conexao['output_component_id'] && $conexao['type_output'] === 'controller'){
					$vetorAux[] = $conexao; 
				}
			}
			foreach($project['sensor'] as $sensor){
				if($sensor['id'] === $conexao['output_component_id'] && $conexao['type_output'] === 'sensor'){
					$vetorAux[] = $conexao;
				}
			}
			if($project['controlledProcess']['id'] === $conexao['output_component_id'] && $conexao['type_output'] === 'controlled_process'){
				$vetorAux[] = $conexao;
			}
		}
		$project['connections'] = $vetorAux;

		$variaveis = Variable::where("project_id", $request->get('project_id'))->get();
		foreach($project['controllers'] as $controlador){
			$vetorAuxII = array();
			foreach($variaveis as $variavel){
				if($variavel['controller_id'] === $controlador['id'] || $variavel['controller_id'] === 0){
					$vetorAuxII[] = $variavel;
				}
			}
			$controlador['variables'] = $vetorAuxII;
			foreach($controlador['variables'] as $i){
				$i['state'] = State::where('variable_id', $i['id'])->get();
			}
		}
		
		return json_encode($project);

		//return readfile(json_encode($nomeArquivo));
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
