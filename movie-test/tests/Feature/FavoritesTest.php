<?php

namespace Tests\Feature;

// Jobs
use App\Jobs\Api\Movies\ConsultFavorites;
use App\Jobs\Api\Movies\CreateFavorite;
use App\Jobs\Api\Movies\RemoveFavorite;
use App\Jobs\Api\Users\CreateUser;

// Models
use App\Models\User;

// Required Libraries
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class FavoritesTest extends TestCase
{
    
    /**
     * @test
     */
    public function createFavorite()
    {
        $data_user = [
            "name" => 'Test Name ' . time(),
            "email" => 'test.fav.' . time() . '@test.com',
            "password" => '12345',
            "password_confirmation" => '12345'
        ];

        $user = Bus::dispatchNow( new CreateUser( $data_user ) );
        
        $data = ['movie_id' => 446893];

        $favorite = Bus::dispatchNow(
            new CreateFavorite(
                $user,
                $data
            )
        );

        $this->assertTrue($favorite);
    }
    
    /**
     * @test
     */
    public function consultFavorites()
    {
        $user = User::orderBy('id', 'DESC')->first();
        
        $favorites = Bus::dispatchNow(
            new ConsultFavorites($user)
        );

        $this->assertIsArray($favorites);
    }
    
    /**
     * @test
     */
    public function removeFavorite()
    {
        $user = User::orderBy('id', 'DESC')->first();
        $data = ['movie_id' => 446893];

        $favorite = Bus::dispatchNow(
            new RemoveFavorite( $user , $data )
        );
        
        $user->delete();
        $this->assertTrue($favorite);
    }
}
