<?php

namespace FixNairobi\Http\Controllers;


use FixNairobi\Http\Middleware\Admin;
use FixNairobi\User;
use Illuminate\Http\Request;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    /**
     * Checks if an admin can access this page
     */
public  function test_admin_not_redirected(){
    $user = factory(User::class)->create([
        'isAdmin'=>'1'
    ]);
    $response = $this->be($user)->withMiddleware(Admin::class)->get('/admin');
    $response->assertLocation('/admin');
}
    /**
     * redirects to login page
     */
    public  function  testAdmin_not_authenitaced(){
        $user = factory(User::class)->create();
        $this->be($user)->withSession(['foo'=>'foo']);
        $response = $this->withMiddleware(Admin::class)->get('/admin');
        $response->assertStatus(404);
        $this->assertEquals($response->getStatusCode(),404 );

    }
}
