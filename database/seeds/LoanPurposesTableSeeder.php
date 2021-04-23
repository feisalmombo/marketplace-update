<?php

use Illuminate\Database\Seeder;
use App\LoanPurpose;

class LoanPurposesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loanPurpose = new LoanPurpose();
        $loanPurpose->loan_purpose_name = 'Holiday';
        $loanPurpose->save();

        $loanPurpose = new LoanPurpose();
        $loanPurpose->loan_purpose_name = 'Household Goods';
        $loanPurpose->save();

        $loanPurpose = new LoanPurpose();
        $loanPurpose->loan_purpose_name = 'Medical Fees';
        $loanPurpose->save();

        $loanPurpose = new LoanPurpose();
        $loanPurpose->loan_purpose_name = 'Rent';
        $loanPurpose->save();

        $loanPurpose = new LoanPurpose();
        $loanPurpose->loan_purpose_name = 'Education';
        $loanPurpose->save();

        $loanPurpose = new LoanPurpose();
        $loanPurpose->loan_purpose_name = 'Wedding';
        $loanPurpose->save();

        $loanPurpose = new LoanPurpose();
        $loanPurpose->loan_purpose_name = 'Business';
        $loanPurpose->save();

        $loanPurpose = new LoanPurpose();
        $loanPurpose->loan_purpose_name = 'Agriculture';
        $loanPurpose->save();

        $loanPurpose = new LoanPurpose();
        $loanPurpose->loan_purpose_name = 'Car/Auto';
        $loanPurpose->save();

        $loanPurpose = new LoanPurpose();
        $loanPurpose->loan_purpose_name = 'Asset Finance';
        $loanPurpose->save();

        $loanPurpose = new LoanPurpose();
        $loanPurpose->loan_purpose_name = 'Mortgage/Home';
        $loanPurpose->save();

        $loanPurpose = new LoanPurpose();
        $loanPurpose->loan_purpose_name = 'Other';
        $loanPurpose->save();
    }
}
