<?php

namespace FixNairobi\Http\Controllers;


use FixNairobi\TypeIssues;
use FixNairobi\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Tests\TestCase;

class ReportControllerTest extends TestCase
{

    use RefreshDatabase;

    public function testUser_notauthenticated()
    {

        $response = $this->get('/reportproblem');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testShow()
    {
        $this->withoutMiddleware();
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/reportproblem');
        $response->assertStatus(200);
    }
/*
    public function testReportIssue()*/
}
