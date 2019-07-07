<?php

use FixNairobi\Http\Middleware\VerifyCsrfToken;
use FixNairobi\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class ForgotPasswordTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanViewAnEmailPasswordForm()
    {
        $response = $this->get($this->passwordRequestRoute());
        $response->assertSuccessful();
        $response->assertViewIs('auth.passwords.email');
    }

    protected function passwordRequestRoute()
    {
        return route('password.request');
    }

    public function testUserCannotViewAnEmailPasswordFormWhenAuthenticated()
    {
        $user = factory(User::class)->make();
        $response = $this->actingAs($user)->get($this->passwordRequestRoute());
        $response->assertRedirect($this->guestMiddlewareRoute());
    }

    protected function guestMiddlewareRoute()
    {
        return route('home');
    }

    public function testUserReceivesAnEmailWithAPasswordResetLink()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);
        Notification::fake();
        $user = factory(User::class)->create([
            'email' => 'john@example.com',
        ]);
        $response = $this->post($this->passwordEmailPostRoute(), [
            'email' => 'john@example.com',
        ]);
        $this->assertNotNull($token = DB::table('password_resets')->first());
        Notification::assertSentTo($user, ResetPassword::class, function ($notification, $channels) use ($token) {
            return Hash::check($notification->token, $token->token) === true;
        });
    }

    protected function passwordEmailPostRoute()
    {
        return route('password.email');
    }

    public function testUserDoesNotReceiveEmailWhenNotRegistered()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);
        Notification::fake();
        $response = $this->from($this->passwordEmailGetRoute())->post($this->passwordEmailPostRoute(), [
            'email' => 'nobody@example.com',
        ]);
        $response->assertRedirect($this->passwordEmailGetRoute());
        $response->assertSessionHasErrors('email');
        Notification::assertNotSentTo(factory(User::class)->make(['email' => 'nobody@example.com']), ResetPassword::class);
    }

    protected function passwordEmailGetRoute()
    {
        return route('password.email');
    }

    public function testEmailIsRequired()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $response = $this->from($this->passwordEmailGetRoute())->post($this->passwordEmailPostRoute(), []);
        $response->assertRedirect($this->passwordEmailGetRoute());
        $response->assertSessionHasErrors('email');
    }

    public function testEmailIsAValidEmail()
    {
        $this->withoutMiddleware(VerifyCsrfToken::class);
        $response = $this->from($this->passwordEmailGetRoute())->post($this->passwordEmailPostRoute(), [
            'email' => 'invalid-email',
        ]);
        $response->assertRedirect($this->passwordEmailGetRoute());
        $response->assertSessionHasErrors('email');
    }
}