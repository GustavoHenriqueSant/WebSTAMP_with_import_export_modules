<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->visit('/')
             ->see('STAMP');
    }

    public function testAddAccident()
    {
        $this->press('+');
        $this->visit('/addaccident')
             ->type('Accident', 'name')
             ->press('Add');
    }
}
