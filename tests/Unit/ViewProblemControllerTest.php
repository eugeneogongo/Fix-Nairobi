<?php
/**
 * Developed by Eugene Ogongo on 8/1/19 2:06 PM
 * Author Email: eugeneogongo@live.com
 * Last Modified 8/1/19 2:06 PM
 * Copyright (c) 2019 . All rights reserved
 */

namespace FixNairobi\Http\Controllers;


use FixNairobi\Problem;
use FixNairobi\TypeIssues;
use FixNairobi\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ViewProblemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testViewIssue()
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
        $problem = Problem::all()->where('landmark', '=', 'gachoro');
        $this->assertNotNull($problem);
        $response = $this->get('/viewissue/'.$problem[0]->id);
        $response->assertStatus(200);
        $response->assertSee('gachoro');
    }

    public function testthrows404()
    {
        $response = $this->get('/viewissues/100000');
        $response->assertStatus(404);

    }

    /*  public function testIssueFixed()
      {
          Artisan::call('db:seed');
          $user = factory(User::class)->create([
              'isAdmin'=>'1'
          ]);
          $issuestatus = IssueStatus::where('status','Not Fixed')->first();
          $this->withoutMiddleware();

          $response  = $this->be($user)->post('fix',[
          'id'=>1
          ]);
         $response->assertStatus(200);
         $this->assertDatabaseHas('issuestatus',[
             'issueid'=>1,
             'status'=>'Fixed'
         ]);

  }*/
}
