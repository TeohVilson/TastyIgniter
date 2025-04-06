<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Date;
use Tests\TestCase;

class AttributeCastingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_casts_email_verified_at_to_datetime()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Assert that email_verified_at is an instance of Carbon (datetime)
        $this->assertInstanceOf(\Carbon\Carbon::class, $user->email_verified_at);
    }
}
