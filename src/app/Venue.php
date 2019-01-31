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
    protected $fillable = ['title', 'slug', 'description', 'address1', 'address2', 'city', 'state', 'postcode', 'country', 'url', 'phone', 'latitude', 'longitude', 'capacity_turn', 'capacity_group', 'quantity_group', 'image'];

    /**
     * @var mixed
     */
    public $timestamps = true;

    /**
     * Relation
     * @return mixed
     */
    public function admins()
    {
        return $this->belongsToMany('App\Admin', 'venue_admin', 'venue_id', 'admin_id');
    }
}
