<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Role;
use App\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $dev_permission = Permission::where('slug','create')->first();
        $manager_permission = Permission::where('slug', 'edit')->first();
        $admin_permission = Permission::where('slug', 'delete')->first();
        $financialAgent_permission = Permission::where('slug', 'update')->first();
        $borrower_permission = Permission::where('slug', 'create_inquiries')->first();


        $dev_role = new Role();
        $dev_role->slug = 'developer';
        $dev_role->name = 'Developer';
        $dev_role->save();
        $dev_role->permissions()->attach($dev_permission);

        $manager_role = new Role();
        $manager_role->slug = 'manager';
        $manager_role->name = 'Manager';
        $manager_role->save();
		$manager_role->permissions()->attach($manager_permission);

        $admin_role=new Role();
    	$admin_role->slug = 'administrator';
    	$admin_role->name = 'Administrator';
    	$admin_role->save();
		$admin_role->permissions()->attach($admin_permission);

		$financialAgent_role=new Role();
    	$financialAgent_role->slug = 'financial agent';
    	$financialAgent_role->name = 'Financial Agent';
    	$financialAgent_role->save();
		$financialAgent_role->permissions()->attach($financialAgent_permission);

		$borrower_role=new Role();
    	$borrower_role->slug = 'borrower';
    	$borrower_role->name = 'Borrower';
    	$borrower_role->save();
		$borrower_role->permissions()->attach($borrower_permission);

    }
}
