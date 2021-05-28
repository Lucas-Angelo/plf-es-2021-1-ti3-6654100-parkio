<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class  BlockManagerHasDestination extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'block_manager_has_destination';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id',
        'destination_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [

    ];
    
}
