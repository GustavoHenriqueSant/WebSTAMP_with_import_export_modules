<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(SystemGoalsTableSeeder::class);
        $this->call(AccidentsTableSeeder::class);
        $this->call(HazardsTableSeeder::class);
        $this->call(AccidentsHazardsTableSeeder::class);
        $this->call(ComponentsTableSeeder::class);
        $this->call(ActuatorsTableSeeder::class);
        $this->call(SensorsTableSeeder::class);
        $this->call(ControlledProcessesTableSeeder::class);
        $this->call(ControllersTableSeeder::class);
        $this->call(VariablesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(ConnectionsTableSeeder::class);
        $this->call(ControlActionsTableSeeder::class);
        // $this->call(RulesTableSeeder::class);
        $this->call(SystemSafetyConstraintTableSeeder::class);
        $this->call(SafetyConstraintsTableSeeder::class);
        $this->call(GuidewordsTableSeeder::class);
        $this->call(CausalAnalysisTableSeeder::class);
    }
}
