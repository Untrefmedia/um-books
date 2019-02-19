<?php

namespace Untrefmedia\UMBooks\App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
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
    protected $table = 'events';

    /**
     * @var array
     */
    protected $fillable = ['title', 'slug', 'start_date', 'byday', 'freq', 'venue_id', 'admin_id'];

    /**
     * @var mixed
     */
    public $timestamps = true;

    /**
     * Relation
     * @return mixed
     */
    public function createdByAdmin()
    {
        return $this->belongsTo('App\Admin', 'admin_id', 'id');
    }

    /**
     * Relation
     * @return mixed
     */
    public function venues()
    {
        return $this->belongsTo('Untrefmedia\UMBooks\App\Venue', 'venue_id', 'id');
    }
}
