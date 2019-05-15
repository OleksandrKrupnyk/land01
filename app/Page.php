<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Page
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Page query()
 * @mixin \Eloquent
 */
class Page extends Model
{

    protected $guarded = ['id'];
    public $timestamps = true;
    //Accessor
    public function getShortTextAttribute()
    {
        return mb_substr($this->text, 0,100);
    }
}
