<?php

use Illuminate\Database\Seeder;
use App\Permissions\HasPermissionsTrait;
use App\Role;
use App\Permission;

class PermissionTableSeeder extends Seeder
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

        $createUsers = new Permission();
        $createUsers->slug = 'create';
        $createUsers->name = 'Create';
        $createUsers->save();
        $createUsers->roles()->attach($dev_role);

        $editUsers = new Permission();
        $editUsers->slug = 'edit';
        $editUsers->name = 'Edit';
        $editUsers->save();
        $editUsers->roles()->attach($manager_role);

        $deleteUsers = new Permission();
        $deleteUsers->slug = 'delete';
        $deleteUsers->name = 'Delete';
        $deleteUsers->save();
        $deleteUsers->roles()->attach($admin_role);

        $updateUsers = new Permission();
        $updateUsers->slug = 'update';
        $updateUsers->name = 'Update';
        $updateUsers->save();
        $updateUsers->roles()->attach($financialAgent_role);

        $createInquiries = new Permission();
        $createInquiries->slug = 'create_inquiries';
        $createInquiries->name = 'Create Inquiries';
        $createInquiries->save();
        $createInquiries->roles()->attach($borrower_role);

    }
}
