<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Destination extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    // Laravel documentation: https://laravel.com/docs/7.x/eloquent

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'destination';

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = off;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'block',
        'apartament'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
