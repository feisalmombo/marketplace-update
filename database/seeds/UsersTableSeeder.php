<?php

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Role;
use App\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dev_role = Role::where('slug', 'developer')->first();
        $manager_role = Role::where('slug', 'manager')->first();
        $admin_role = Role::where('slug',  'administrator')->first();
        $financialAgent_role = Role::where('slug',  'financial agent')->first();
        $borrower_role = Role::where('slug',  'borrower')->first();


        $dev_permission = Permission::where('slug','create')->first();
        $manager_permission = Permission::where('slug', 'edit')->first();
        $admin_permission = Permission::where('slug', 'delete')->first();
        $financialAgent_permission = Permission::where('slug', 'update')->first();
        $borrower_permission = Permission::where('slug', 'create_inquiries')->first();


        $developer = new User();
        $developer->full_name = 'Feisal Mombo';
        $developer->email = 'feisal.mombo@getpesa.co.tz';
        $developer->phone_number = '255684456287';
        $developer->password = bcrypt('123456');
        $developer->created_at = Carbon::now();
        $developer->updated_at = Carbon::now();
        $developer->save();
        $developer->roles()->attach($dev_role);
        $developer->permissions()->attach($dev_permission);


        $manager = new User();
        $manager->full_name = 'Imani';
        $manager->email = 'imani.alfayo@getpesa.co.tz';
        $manager->phone_number = '255654321222';
        $manager->password = bcrypt('123456');
        $manager->created_at = Carbon::now();
        $manager->updated_at = Carbon::now();
        $manager->save();
        $manager->roles()->attach($manager_role);
        $manager->permissions()->attach($manager_permission);


    }
}

