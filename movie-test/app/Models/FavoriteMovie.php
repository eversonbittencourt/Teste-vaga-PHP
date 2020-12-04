<?php

namespace App\Models;

// Required Libraries
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as AuditableUse;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;

class FavoriteMovie extends Model implements Auditable  
{
    use AuditableUse, SoftDeletes, HasFactory;

    /**************************************************************/
    /*************************** CONFIGS **************************/

    protected $table = 'favorite_movies';

    protected $fillable = [
        'user_id',
        'movie_id',
    ];

    /**************************************************************/
    /*************************** RELATIONS ************************/

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
