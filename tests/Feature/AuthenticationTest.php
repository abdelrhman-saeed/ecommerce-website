<?php

namespace Tests\AuthenticationControllerTests\Feature;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Mockery\MockInterface;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
   use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

     public function testLoginWhileAuthenticated()
     {
         $this->actingAs(User::factory()->create())
               ->get('/login')
               ->assertRedirect('/home');
     }

     public function testLoginWhileGuest()
     {
        $this->get('/login')->assertOk();
     }

     public function testaccessWhileGuest()
     {
        $this->get('/home')->assertRedirect('/login');
     }

     public function testLogingOut() {
         $this->actingAs(User::factory()->create())
               ->get('/logout')
               ->assertRedirect('/login');
     }

   public function testThatRegisteredEventIsDispatched()
   {
      Event::fake();

      $this->userinfo = [
         'name' => 'abdelrhman',
         'email' => 'abdelrhmanSaeed001@gmail.com',
         'password' => 'abdelrhman',
         'password_confirmation' => 'abdelrhman',
         'phone' => '01022077166'
      ];

      $this->post('/users', $this->userinfo)
            ->assertRedirect('/email/verify');

      Event::assertDispatched(Registered::class);
   }
}
