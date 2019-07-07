<?php

namespace FixNairobi\Http\Controllers;


use FixNairobi\Mail\ProblemReported;
use FixNairobi\Photo;
use FixNairobi\TypeIssues;
use FixNairobi\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
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

    public function testReportIssue()
    {
        $this->withoutMiddleware();
        Mail::fake();
        Mail::assertNothingQueued();
        $user = factory(User::class)->create([
            'isAdmin' => '1'
        ]);
        Storage::fake('local');

        $issue = new TypeIssues();
        $issue->desc = "test";
        $issue->save();
        $id = $issue->id;

        $this->assertDatabaseHas('Type_issues', [
            'desc' => 'test'
        ]);
        $file = UploadedFile::fake()->image('test.jpg');
        $response = $this->actingAs($user)->post('/reportproblem', [
            'location' => '(123,124)',
            'issueid' => $id,
            'landmark' => 'gachoro',
            'moredetails' => 'moredetails',
            'desc' => 'Hello world',
            'image1' => $file
        ]);

        $response->assertStatus(200);

        // Assert the file was stored...
        Storage::disk('local')->assertExists('public', $file->hashName());

        $this->assertDatabaseHas('problems', [
            'Title' => 'Hello world',
        ]);
        $this->assertDatabaseHas('IssueStatus', [
            'status' => 'Not Fixed'
        ]);
        Mail::assertSent(ProblemReported::class,1);
        $content = json_decode($response->getContent());
        $this->assertObjectHasAttribute('status', $content);
    }


    public function testreportfeed()
    {
        $this->withoutMiddleware();
        $response = $this->get('file-a-complain');
        $response->assertStatus(200);
        $response->assertSee("Report a Complainant or Leave a Feedback");

        $response = $this->post('file-a-complain', [
            'email' => 'me@sample.com',
            'message' => 'hello'
        ]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('feedback', [
            'email' => 'me@sample.com',
            'message' => 'hello'
        ]);
        $response->assertSee('Message Received!');
    }
}
