<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Onboarding extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $searchableColumns = [
        'name' => 20,
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mobile_onboarding';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['description', 'name', 'image'];

    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumb')
            ->setManipulations(['w' => 50, 'h' => 50, 'q' => 100, 'fit' => 'crop'])
            ->performOnCollections('onboarding');

        $this->addMediaConversion('form')
            ->setManipulations(['w' => 70, 'h' => 70, 'q' => 100, 'fit' => 'crop'])
            ->performOnCollections('onboarding', 'onboarding');
    }

}
