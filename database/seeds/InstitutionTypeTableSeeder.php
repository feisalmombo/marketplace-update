<?php

use Illuminate\Database\Seeder;
use App\InstitutionType;

class InstitutionTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $institution = new InstitutionType();
        $institution->institution_type_name = 'Commercial Bank';
        $institution->save();

        $institution = new InstitutionType();
        $institution->institution_type_name = 'Community Bank';
        $institution->save();

        $institution = new InstitutionType();
        $institution->institution_type_name = 'Microfinance Bank';
        $institution->save();

        $institution = new InstitutionType();
        $institution->institution_type_name = 'Development Finance Bank';
        $institution->save();

        $institution = new InstitutionType();
        $institution->institution_type_name = 'Credit Reference Bureau';
        $institution->save();

        $institution = new InstitutionType();
        $institution->institution_type_name = 'Financial Leasing Company';
        $institution->save();

        $institution = new InstitutionType();
        $institution->institution_type_name = 'Mortgage Finance Institution';
        $institution->save();

        $institution = new InstitutionType();
        $institution->institution_type_name = 'Representative office of foreign banks';
        $institution->save();
    }
}
