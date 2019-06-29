<?php

namespace FixNairobi\Http\Controllers;


use FixNairobi\Http\Middleware\Admin;
use FixNairobi\Jobs\BulkEmailJob;
use FixNairobi\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class BroadCastControllerTest extends TestCase
{
    Use RefreshDatabase;

    /**
     *Test if only admins can view it
     */
    public function testShow()
    {
        $user = factory(User::class)->create([
            'isAdmin' => '1'
        ]);
        $response = $this->be($user)->withMiddleware(Admin::class)->get('/broadcast');
        $response->assertStatus(200);
    }

    public function testShow_non_Admin()
    {
        $user = factory(User::class)->create();
        $response = $this->be($user)->withMiddleware(Admin::class)->get('/broadcast');
        $response->assertStatus(404);
    }

    public function testSend()
    {
        $this->withoutMiddleware();
        Queue::fake();
        // Assert that no jobs were pushed...
        Queue::assertNothingPushed();
        $users = null;
        for ($i = 0; $i < 10; $i++) {
            $users[$i] = factory(User::class)->create();
        }
        $admin = factory(User::class)->create([
            'isAdmin' => '1'
        ]);

        $response = $this->actingAs($admin)->post('/broadcast', [
            'subject' => 'Hello world',
            'editordata' => 'test email'

        ]);
        $response->assertLocation('/admin');
        Queue::assertPushed(BulkEmailJob::class, 11);

    }
}
