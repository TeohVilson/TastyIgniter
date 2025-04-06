<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class MassAssignTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_allows_mass_assignment_of_fillable_attributes()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password')
        ];

        $user = User::create($userData);

        $this->assertEquals($user->name, 'Test User');
        $this->assertEquals($user->email, 'testuser@example.com');
        $this->assertTrue(password_verify('password', $user->password)); // Check password hash
    }

    /** @test */
    public function it_prevents_mass_assignment_of_non_fillable_attributes()
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
            'non_fillable_attribute' => 'test'
        ];

        $user = User::create($userData);

        // Assert that non-fillable attributes are not mass assigned
        $this->assertNull($user->non_fillable_attribute);
    }
}
