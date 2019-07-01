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

    public function testReportIssue()
    {
        $this->withoutMiddleware();
        $user = factory(User::class)->create([
            'isAdmin' => '1'
        ]);
        $stub = __DIR__ . '/test.jpg';
        $name = str_random(8) . '.jpg';
        $path = sys_get_temp_dir() . '/' . $name;

        copy($stub, $path);

        $file = new UploadedFile($path, $name, filesize($path), null, true);

        $issue = new TypeIssues();
        $issue->desc = "test";
        $id = $issue->save();

        $this->assertDatabaseHas('Type_issues', [
            'desc' => 'test'
        ]);

        $response = $this->actingAs($user)->post('/reportproblem', [
            'location' => '(123,124)',
            'issueid' => $id,
            'landmark' => 'gachoro',
            'moredetails' => 'moredetails',
            'desc' => 'Hello world'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('problems', [
             'issueid' => '1',
         ]);
        $this->assertDatabaseHas('IssueStatus', [
            'status' => 'Not Fixed',
            'issueid' => '1'
        ]);
        $content = json_decode($response->getContent());
        $this->assertObjectHasAttribute('status', $content);
    }
}
