<?php

use Illuminate\Database\Seeder;
use App\LoanType;

class LoanTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loan = new LoanType();
        $loan->loan_name = 'Salaried Loans';
        $loan->save();

        $loan = new LoanType();
        $loan->loan_name = 'Mortgage Loan';
        $loan->save();

        $loan = new LoanType();
        $loan->loan_name = 'Personal/business Loans'; 
        $loan->save();

        $loan = new LoanType();
        $loan->loan_name = 'Mortgage loan commercial';
        $loan->save();

        $loan = new LoanType();
        $loan->loan_name = 'Mortgage loan residential';
        $loan->save();

        $loan = new LoanType();
        $loan->loan_name = 'Overdraft Facility Loans';
        $loan->save();

        $loan = new LoanType();
        $loan->loan_name = 'Overdraft facility renewable';
        $loan->save();

        $loan = new LoanType();
        $loan->loan_name = 'Overdraft facility';
        $loan->save();

        $loan = new LoanType();
        $loan->loan_name = 'Mortgage Loans';
        $loan->save();

        $loan = new LoanType();
        $loan->loan_name = 'Corporate Term Loans';
        $loan->save();
    }
}
