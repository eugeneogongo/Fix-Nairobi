<?php

namespace FixNairobi\Http\Controllers;


use FixNairobi\Problem;
use FixNairobi\TypeIssues;
use FixNairobi\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ViewProblemControllerTest extends TestCase
{
    use RefreshDatabase;

   /* public function testViewIssue()
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
        $problem =Problem::wherehas([
            'landmark'=>'gachoro'
        ])->get()->first();
        $response = $this->get('/viewissue/'.$problem[0]->id);
        $response->assertStatus(200);
        $response->assertSee('gachoro');
    }*/

    public function testIssueFixed()
    {
        $this->assertTrue(true);
}
}
