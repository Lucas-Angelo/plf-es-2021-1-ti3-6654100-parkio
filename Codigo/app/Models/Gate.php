<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Gate extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;
    // Laravel documentation: https://laravel.com/docs/7.x/eloquent

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'gate';

    protected $primaryKey = 'id';

    public $incrementing = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $casts = [
         'created_at' => 'datetime:Y-m-d H:i:s',
         'updated_at' => 'datetime:Y-m-d H:i:s',
     ];


    protected $fillable = [
        'description',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];
}
