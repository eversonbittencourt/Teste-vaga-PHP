<?php

namespace App\Http\Controllers\Api;

// Required Libraries
use App\Http\Controllers\Controller;

// Requests
use App\Http\Requests\Api\Users\LoginRequest;
use App\Http\Requests\Api\Users\StoreRequest;

// Resources
use App\Http\Resources\Api\UserResource;
use App\Jobs\Api\Users\CreateUser;

// Models
use App\Models\User;

class UsersController extends Controller
{
    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->get('email'))
                    ->first();

        if ( $user ) {
            if (! $token = auth('api')->attempt($request->all())) {
                return response()->json(['status' => 'error', 'message' => 'Erro na autenticacao'], 400);
            } else {
                
                return response()->json([ 'status' => 'success', 'token' => $token, 'user' => ( new UserResource($user) ) ]);
            }
        }
        return response()->json( ['status' => 'error', 'message' => 'Usuário não localizado.'] , 404 );
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $user = $this->dispatchNow(
            new CreateUser( $request->all() )
        );

        if ( $user )
            return response()->json(['status' => 'success', 'message' => 'Usuário criado com sucesso.', 'user' => ( new UserResource($user) ) ]);

        return response()->json( ['status' => 'error', 'message' => 'Erro ao criar usuário.'] , 500 );
    }
}
