<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    public function testRegistration()
    {

        $this->visit('/')
            ->see('Login')
            ->click('Register Account')
            ->type('Test Account', 'name')
            ->type('phpunit@tutelagesystems.com', 'email')
            ->type('welcome', 'password')
            ->type('welcome', 'password_confirmation')
            ->press('Register')
            ->see('My Account');

        $this->seeInDatabase('users', ['email' => 'test@tutelagesystems.com']);
    }

    public function testLogin()
    {
        $this->visit('/')
            ->see('Login')
            ->type('mickey@tutelagesystems.com', 'email')
            ->type('welcome', 'password')
            ->press('Login')
            ->see('My Account');
    }

    public function testLogout()
    {
        $this->visit('/')
            ->see('Login')
            ->type('mickey@tutelagesystems.com', 'email')
            ->type('welcome', 'password')
            ->press('Login')
            ->see('My Account')
            ->click('Logout')
            ->see('Login');
    }



}