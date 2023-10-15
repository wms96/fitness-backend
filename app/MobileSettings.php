<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MobileSettings extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mobile_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['on_boarding'];
}
