<?php

namespace App\Jobs\Api\Movies;

// Models
use App\Models\User;

// Services
use App\Services\TheMovieDb;

// Required Libraries
use Illuminate\Foundation\Bus\Dispatchable;

class ConsultFavorites
{
    use Dispatchable;

    /**
     * @var User
     */
    private $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ( !$this->user->favorite_movies )
            return false;
        
        $result = [];
        foreach ( $this->user->favorite_movies as $favorite ) {
            $movie = ( new TheMovieDb )->getMovieById( $favorite->movie_id );
            if ( $movie )
                $result[] = $movie;
        }
        
        if ( $result )
            return collect($result)->toArray();

        return false;
    }
}
