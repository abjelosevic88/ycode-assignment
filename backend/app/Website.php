<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    const PAGINATION_LIMIT = 10;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'url'
    ];
}
