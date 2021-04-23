<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LoanTypeTableSeeder::class);
        $this->call(DurationsTableSeeder::class);
        $this->call(InstitutionTypeTableSeeder::class);
        $this->call(LoanPurposesTableSeeder::class);
        $this->call(CitySeeder::class);
    }
}
