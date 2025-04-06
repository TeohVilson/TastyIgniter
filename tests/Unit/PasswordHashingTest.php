<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\TestCase;

class PasswordHashingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_hashes_the_password_when_created()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'plainpassword',
        ]);

        // Assert that the password is hashed and not plain text
        $this->assertTrue(Hash::check('plainpassword', $user->password));
    }
}
