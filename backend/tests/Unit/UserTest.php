<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function testUserCreatedWithInvalidData(): void
    {
        $data = [
            'name' => 1234,
            'email' => 'invalid_email',
            'password' => '1234',
        ];

        $user = (new User())->createUser($data);
        $this->expectExceptionMessage($user);
    }
}
