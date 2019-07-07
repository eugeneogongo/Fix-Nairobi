<?php

namespace FixNairobi\Http\Controllers;


use FixNairobi\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomeControllerTest extends TestCase
{
    use RefreshDatabase;
    public  function  testuser_auth(){
        $user = factory(User::class)->create();
        $this->actingAs($user);
        $response = $this->get('/login');
        $response->assertLocation('/home');
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
