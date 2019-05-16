<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Portfolio
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Portfolio newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Portfolio newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Portfolio query()
 * @mixin \Eloquent
 */
class Portfolio extends Model
{
    //
    protected $guarded = ['id'];
    public $timestamps = true;
}
