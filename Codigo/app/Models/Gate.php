<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gate extends Model
{

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
