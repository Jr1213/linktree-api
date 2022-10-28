<?php

namespace Tests\Feature\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_account()
    {
        $user = User::factory()->make();
        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'password' => '12345678',
            'password_confirmation' => '12345678',
            'username' => $user->username
        ];

        $reponse = $this->postJson('api/Auth', $data)->assertCreated()->json();

        $this->assertDatabaseHas('users', $user->only(['phone', 'name', 'email']));

        $this->assertEquals(true, $reponse['success']);
    }


    public function test_user_can_login_his_account()
    {
        $user = User::factory()->create();

        $response = $this->postJson('api/Login', ['email' => $user->email, 'password' => "password"]);

        $response->assertOk();

        $response->json();

        $this->assertEquals('true',$response['success']);

        $this->assertNotEmpty($response['token']);
    }
}
