<?php

namespace Untrefmedia\UMBooks\App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    use Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * @var string
     */
    protected $table = 'venues';

    /**
     * @var array
     */
    protected $fillable = ['title', 'slug', 'description', 'address1', 'address2', 'city', 'state', 'postcode', 'country', 'url', 'phone', 'latitude', 'longitude'];

    /**
     * @var mixed
     */
    public $timestamps = true;
}
