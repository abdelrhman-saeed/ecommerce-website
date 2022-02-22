<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;


class UserControllerTest extends TestCase
{
   use RefreshDatabase;

   public function testUserRegisteredAndStored()
   {

      $userinfo = [
         'name' => 'abdelrhman',
         'email' => 'abdelrhmanSaeed001@gmail.com',
         'password' => 'abdelrhman',
         'password_confirmation' => 'abdelrhman',
         'phone' => '01022077166'
      ];

      $this->assertTrue(User::count() == 0);

      $this->post('/users', $userinfo)
            ->assertRedirect('/email/verify');
            
      $this->assertTrue(auth()->check());
      $this->assertTrue(User::count() == 1);
   }

    public function testUpdateMethod() {

        $user = User::factory()->create();
        $newUserData = [
           'name' => 'ahmed',
           'email' => 'okaytion@okaytion.com',
           'phone' => '12345678901'
        ];
  
        $respone = $this->actingAs($user)->put('/users/'. $user->id, $newUserData);
        $respone->assertStatus(302);
        $user->refresh();
  
        $this->assertSame($newUserData, [
           'name' => $user->name,
           'email' => $user->email,
           'phone' => $user->phone
        ]);
     }
  
     public function testDeleteMethod() {
  
        $user = User::factory(2)->create()[0];
  
        $this->assertTrue(user::count() === 2);
        $this->actingAs($user)
              ->delete('/users/'. $user->id)
              ->assertRedirect('/home');
  
        $this->assertTrue(User::count() === 1);
        $this->expectException(ModelNotFoundException::class);
  
        User::where('email', $user->email)->firstOrFail();
     }
}
