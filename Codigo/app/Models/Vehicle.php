<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Vehicle extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    // Laravel documentation: https://laravel.com/docs/7.x/eloquent

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'vehicle';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $dateFormat = '';

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'driver_name', 'cpf', 'plate', 'model',
        'color', 'time', 'left_at', 'score',
        'destination_id', 'visitor_category_id',
        'gate_id', 'user_in_id', 'user_out_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function gate(){
        return $this->belongsTo('App\Models\Gate');
    }

    public function userIn(){
        return $this->belongsTo('App\Models\User', 'user_in_id');
    }

    public function userOut(){
        return $this->belongsTo('App\Models\User', 'user_out_id');
    }

    public function destination(){
        return $this->belongsTo('App\Models\Destination');
    }
}
