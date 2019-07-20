<?php
/**
 * Developed by Eugene Ogongo on 7/20/19 10:44 AM
 * Author Email: eugeneogongo@live.com
 * Last Modified 7/20/19 10:41 AM
 * Copyright (c) 2019 . All rights reserved
 */

namespace FixNairobi\Http\Controllers;


use FixNairobi\Http\Middleware\Admin;
use FixNairobi\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class AdminControllerTest extends TestCase
{
    Use RefreshDatabase;
    /**
     * Checks if an admin can access this page
     */
public  function test_admin_not_redirected(){
    $user = factory(User::class)->create([
        'isAdmin'=>'1'
    ]);
    $response = $this->be($user)->withMiddleware(Admin::class)->get('/admin');
    $response->assertStatus(200);
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
    public function testFeedbacks(){
        $this->withoutMiddleware();
        $response = $this->get('feedbacks');
        $response->assertStatus(200);
        $response->assertViewHas('feedbacks');
    }
}
