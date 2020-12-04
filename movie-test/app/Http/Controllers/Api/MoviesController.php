<?php

namespace App\Http\Controllers\Api;

// Required Libraries
use App\Http\Controllers\Controller;

// Resources
use App\Http\Resources\Api\MovieResource;

// Jobs
use App\Jobs\Api\Movies\CreateFavorite;
use App\Jobs\Api\Movies\RemoveFavorite;
use App\Jobs\Api\Movies\ConsultFavorites;

// Services 
use App\Services\TheMovieDb;

// Requests 
use App\Http\Requests\Api\Movies\FavoriteRequest;
use App\Http\Requests\Api\Movies\MoviesRequest;
use App\Http\Requests\Api\Movies\RemoveFavoriteRequest;

class MoviesController extends Controller
{
    /**
     * @param MoviesRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function movies(MoviesRequest $request)
    {

        $movies = ( new TheMovieDb )->getMovies( $request->all() );
        if ( $movies )
            return response()->json( ['status' => 'success', 'message' => 'Videos localizados.', 'movies' => MovieResource::collection($movies) ] );
            
        return response()->json( ['status' => 'error', 'message' => 'Nenhum video localizado.'], 404 );
    }

    /**
     * @param FavoriteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function favorite( FavoriteRequest $request )
    {
        $movie = ( new TheMovieDb )->getMovieById( $request->get('movie_id') );
        if ( !$movie )
            return response()->json( ['status' => 'error', 'message' => 'Filme não localizado.'], 404 ); 

        $user = auth()->user();
        $movie = $user->favorite_movies()->where( 'movie_id' , $request->get('movie_id') )->first();
        
        if ( $movie )
            return response()->json( ['status' => 'error', 'Filme ja se encontra na lista de favoritos.'], 500 );
            
        $favorite = $this->dispatchNow(
            new CreateFavorite( $user , $request->all() )
        );

        if ( $favorite )
            return response()->json( ['status' => 'success', 'message' => 'Filme inserido na lista de favoritos com sucesso.'] );
        
        return response()->json( ['status' => 'error', 'message' => 'Erro ao inserir filme na lista de favoritos.'], 500 );
    }

    /**
     * @param RemoveFavoriteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFavorite( RemoveFavoriteRequest $request )
    {
        $user = auth()->user();
        $removeFavorite = $this->dispatchNow(
            new RemoveFavorite($user, $request->all() )  
        );
        
        if ( $removeFavorite )
            return response()->json( ['status' => 'success', 'message' => 'Filme removido dos favoritos com sucesso.'] );
        
        return response()->json( ['status' => 'error', 'message' => 'Erro ao remover filme dos favoritos.'], 500 );
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function favorites()
    {
        $user = auth()->user();
        $favorites = $this->dispatchNow(
            new ConsultFavorites( $user )
        );
        
        if ( $favorites )
            return response()->json( ['status' => 'success', 'message' => 'Favoritos localizados.', 'favorites' => MovieResource::collection( collect( $favorites ) ) ] );

        return response()->json( ['status' => 'error', 'message' => 'Nenhum favorito localizado.'], 404 );
    }
}
