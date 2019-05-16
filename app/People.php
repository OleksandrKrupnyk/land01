<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\People
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\People query()
 * @mixin \Eloquent
 */
class People extends Model
{
    protected $table = 'peoples';
    public $timestamps = true;

}
