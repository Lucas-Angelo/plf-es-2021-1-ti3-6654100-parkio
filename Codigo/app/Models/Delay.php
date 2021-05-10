<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delay extends Model {

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'delay';

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
        'time',
        'vehicle_id',
        'user_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];

}
