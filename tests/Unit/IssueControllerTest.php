<?php

namespace FixNairobi\Http\Controllers;


use FixNairobi\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class IssueControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Tests if only admins can create issues
     */
    public function testCreateIssue()
    {
        $this->withoutMiddleware();
        $user   = factory(User::class)->create([
            "isAdmin"=>'1'
        ]);
        $response = $this->actingAs($user)->post('/admin/createIssue',[
          'desc'=>'Test',
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('Type_issues',[
            'desc'=>'Test'
        ]);
    }

    /**
     *
     * Tests if only Admin can view /admin/newissue
     */
    public function testShow()
    {
        $user   = factory(User::class)->create([
            'isAdmin'=>'1'
        ]);
       $reponse =  $this->actingAs($user)->withMiddleware('admin')->get('/admin/newIssue');
       $reponse->assertStatus(200);
    }
    public  function  test_non_admin_shows_404(){
        $user   = factory(User::class)->create();
        $reponse =  $this->actingAs($user)->withMiddleware('admin')->get('/admin/newIssue');
        $reponse->assertStatus(404);
    }
}
