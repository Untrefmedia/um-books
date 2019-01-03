<?php

namespace Untrefmedia\UMBooks\App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
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
