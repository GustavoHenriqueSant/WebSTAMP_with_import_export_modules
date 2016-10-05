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
        // $this->call(UsersTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(AccidentsTableSeeder::class);
        $this->call(HazardsTableSeeder::class);
        $this->call(SystemGoalsTableSeeder::class);
        $this->call(VariablesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(ComponentsTableSeeder::class);
        $this->call(ControlActionsTableSeeder::class);
        $this->call(AccidentsHazardsTableSeeder::class);
        $this->call(RulesTableSeeder::class);
        $this->call(SystemSafetyContraintTableSeeder::class);
    }
}
