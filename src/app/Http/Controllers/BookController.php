<?php

namespace Untrefmedia\UMBooks\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Untrefmedia\UMBooks\App\Venue;

class BookController extends Controller
{
    /**
     * @param $venue_id
     */
    public function form($venue_id)
    {
        $capacityGroup = Venue::findOrFail($venue_id)->capacity_group;

        $args = [
            'venueId'      => $venue_id,
            'capacityGroup' => $capacityGroup
        ];

        return view('umbooks::form', $args);
    }
}
