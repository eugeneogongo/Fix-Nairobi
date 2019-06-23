<?php

namespace FixNairobi\Http\Controllers;


use FixNairobi\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{

    public  function  testuser_auth(){
        $user = factory(User::class)->create();
        Auth::login($user);
        $response = $this->get('/reportproblem');
        $response->assertSee($user->name);
    }
    public function testIndex()
    {
        $response  = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('FixNairobi');
    }

    public function testShowAbout()
    {
        $response  = $this->get('/about');
        $response->assertStatus(200);
    }
}
