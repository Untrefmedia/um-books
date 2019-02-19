<?php

namespace Untrefmedia\UMBooks\App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * @var string
     */
    protected $table = 'books';

    /**
     * @var array
     */
    protected $fillable = ['venue_id', 'event_date_start', 'event_date_end', 'detail', 'status'];

    /**
     * @var mixed
     */
    public $timestamps = true;

    /**
     * Relation
     * @return mixed
     */
    public function venues()
    {
        return $this->belongsTo('Untrefmedia\UMBooks\App\Venue', 'venue_id', 'id');
    }
}
