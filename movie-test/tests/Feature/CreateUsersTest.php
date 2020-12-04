<?php

namespace Tests\Feature;

// Jobs
use App\Jobs\Api\Users\CreateUser;

// Models
use App\Models\User;

// Required Libraries
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class CreateUsersTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function createUser()
    {
        $data = [
            "name" => 'Test Name ' . time(),
            "email" => 'test.' . time() . '@test.com',
            "password" => '12345',
            "password_confirmation" => '12345'
        ];

        $user = Bus::dispatchNow( new CreateUser( $data ) );
        
        if ( $user )
            $user->delete();

        $this->assertInstanceOf(User::class, $user);
    }
}