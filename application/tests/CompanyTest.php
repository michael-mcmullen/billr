<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class CompanyTest extends TestCase
{

    use DatabaseTransactions;

    public function testAddCompany()
    {
        // first login
        $this->visit('/')
            ->see('Login')
            ->type('test@tutelagesystems.com', 'email')
            ->type('welcome', 'password')
            ->press('Login')
            ->see('My Account');

        // add company
        $this->click('Add Company')
            ->see('New Company')
            ->type('123456789', 'account_number')
            ->press('Save Company');

        // should fail
        $this->see('Whoops');

        // now make good data
        $this->type('PHP Unit Company', 'company_name')
            ->press('Save Company')
            ->see('Company Listing');
    }
}