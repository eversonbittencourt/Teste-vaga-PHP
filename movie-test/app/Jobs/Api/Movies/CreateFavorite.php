<?php

namespace App\Jobs\Api\Movies;

// Models
use App\Models\User;

// Required Libraries
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class CreateFavorite
{
    use Dispatchable;

    /**
     * @var User
     */
    private $user;

    /**
     * @var Collection
     */
    private $data;

    /**
     * Create a new job instance.
     *
     * @param User $user
     * @param array $data
     * @return void
     */
    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->data = collect($data);
    }

    /**
     * Execute the job.
     *
     * @return boolean
     */
    public function handle()
    {
        try {
            $this->user->favorite_movies()->create( $this->data->toArray() );
            return true;
        } catch ( QueryException $e ) {
            Log::error('Erro ao criar favorito. ' . $e->getMessage());
            return false;
        }
    }
}
