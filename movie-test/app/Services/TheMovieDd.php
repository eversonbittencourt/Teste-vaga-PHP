<?php
namespace App\Services;

// Required Libraries
use Illuminate\Support\Facades\Http;

class TheMovieDb {
    
    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $key;

    
    function __construct()
    {
        $this->url = config('app.the_movie_url');
        $this->key = config('app.the_movie_key');
    }

    /**
     * @param array $params
     * @return Collection|null
     */
    public function getMovies(array $params)
    {
        
        $params['api_key'] = $this->key; 
        $url = $this->url . 'discover/movie';
        $response = Http::get(  $url, $params );

        if ( $response->status() == 200 ) {
            $result = json_decode($response->body());
            if ( isset($result->results) )
                return collect($result->results);
        } else {
            return false;
        }
    }

    /**
     * @param int $movie_id
     * @return object|null
     */
    public function getMovieById( int $movie_id )
    {
        $params = [
            'api_key' => $this->key
        ];
        $url = $this->url . 'movie/' . $movie_id;
        $response = Http::get($url, $params);

        if ( $response->status() == 200 ) {
            $result = json_decode( $response->body() );
            return $result;
        }
        
        return false;
    }
}