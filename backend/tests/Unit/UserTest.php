<?php

namespace Tests\Unit;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    public function testCreateUserWithValidData(): void
    {
        $userData = [
            'name' => 'Marcos G',
            'email' => 'teste@example.com',
            'password' => 'password',
        ];

        $request = RegisterRequest::create('/api/register', 'POST', $userData);

        $user = (new User())->createUser($request->toArray());

        $this->assertInstanceOf(User::class, $user);
        $this->assertEquals($userData['name'], $user->name);
        $this->assertEquals($userData['email'], $user->email);
    }

    public function testCreateUserWithInvalidData(): void
    {
        $invalidData = [
            'name' => 12345,
            'email' => 'mail',
            'password' => 'shor',
        ];
        $response = $this->postJson('/api/register', $invalidData);

        $response
            ->assertStatus(400)
            ->assertJson([
                'name' => [0 => "The name field must be a string."],
                'email' => [0 => "The email field must be a valid email address."],
                'password' => [0 => "The password field must be at least 6 characters."],
            ])
        ;
    }
}
