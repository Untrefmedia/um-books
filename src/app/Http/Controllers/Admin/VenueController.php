<?php

namespace Untrefmedia\UMBooks\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Session;
use Untrefmedia\UMBooks\App\Http\Requests\VenueRequest;
use Untrefmedia\UMBooks\App\Venue;
use URL;
use Yajra\Datatables\Datatables;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('umbooks::admin.models.venue.collection');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('umbooks::admin.models.venue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VenueRequest $request)
    {
        $venue = new Venue();

        $venue->title       = $request->title;
        $venue->slug        = SlugService::createSlug(Venue::class, 'slug', $request->title, ['unique' => true]);
        $venue->description = $request->description;
        $venue->address1    = $request->address1;
        $venue->address2    = $request->address2;
        $venue->city        = $request->city;
        $venue->state       = $request->state;
        $venue->postcode    = $request->postcode;
        $venue->country     = $request->country;
        $venue->url         = $request->url;
        $venue->phone       = $request->phone;
        $venue->latitude    = $request->latitude;
        $venue->longitude   = $request->longitude;
        $venue->save();

        Session::flash('guardado', 'creado correctamente');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $venue = Venue::find($id);

        $args = [
            'venue' => $venue
        ];

        return view('umbooks::admin.models.venue.edit', $args);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VenueRequest $request, $id)
    {
        $venue = Venue::find($id);

        $venue->title       = $request->title;
        $venue->description = $request->description;
        $venue->address1    = $request->address1;
        $venue->address2    = $request->address2;
        $venue->city        = $request->city;
        $venue->state       = $request->state;
        $venue->postcode    = $request->postcode;
        $venue->country     = $request->country;
        $venue->url         = $request->url;
        $venue->phone       = $request->phone;
        $venue->latitude    = $request->latitude;
        $venue->longitude   = $request->longitude;
        $venue->save();

        Session::flash('guardado', 'Editado correctamente');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $venue = Venue::find($id);
        $venue->delete();

        Session::flash('guardado', 'Eliminado correctamente');

        return back();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function dataList()
    {
        return Datatables::of(Venue::query())
            ->addColumn('action', function ($venue) {
                $button_edit = '<a href="' . URL::to("/") . '/admin/venue/' . $venue->id . '/edit   " class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';

                $button_delete =
                '<form method="post" action="venue/' . $venue->id . '">
                    ' . csrf_field() . '
                    <input name="_method" type="hidden" value="DELETE">

                    <button type="submit" class="btn btn-xs btn-danger">
                        <i class="glyphicon glyphicon-remove"></i> Delete
                    </button>
                </form>';

                return '<span style="display: inline-block;">' . $button_edit . '</span> <span style="display: inline-block;">' . $button_delete . '</span>';

            })->make(true);
    }
}
