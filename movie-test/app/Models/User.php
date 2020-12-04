<?php

namespace App\Models;

// Required Libraries
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable as AuditableUse;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable, JWTSubject
{
    use Notifiable, AuditableUse, SoftDeletes;
    

    /**************************************************************/
    /*************************** CONFIGS **************************/
    
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**************************************************************/
    /*************************** RELATIONS ************************/

    public function favorite_movies()
    {
        return $this->hasMany(FavoriteMovie::class);
    }
    
    /**************************************************************/
    /*************************** SETS *****************************/

    public function setEmailAttribute(string $value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function setPasswordAttribute(string $value = null)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
    
    /**************************************************************/
    /**************************** JWT *****************************/

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
