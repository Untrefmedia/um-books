<?php

namespace Untrefmedia\UMBooks\App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Session;
use Untrefmedia\UMBooks\App\Event;
use Untrefmedia\UMBooks\App\Http\Requests\EventRequest;
use Untrefmedia\UMBooks\App\Venue;
use URL;
use Yajra\Datatables\Datatables;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('umbooks::admin.models.event.collection');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $v = Admin::find(Auth::id());

        $new_v = [];

        foreach ($v->venues as $key => $value) {
            $new_v[$value->id] = $value->title;
        }

        $args = [
            'venues' => $new_v
        ];

        return view('umbooks::admin.models.event.create', $args);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        $event             = new Event();
        $event->title      = $request->title;
        $event->slug       = SlugService::createSlug(Event::class, 'slug', $request->title, ['unique' => true]);
        $event->admin_id   = Auth::id();
        $event->start_date = $this->dateFormatCalendar($request->start_date);
        $event->freq       = $request->freq;
        $event->venue_id   = $request->venue_id;
        $event->byday      = json_encode($request->byday);

        // dd($event);

        $event->save();

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
        $event = Event::find($id);


        $v = Admin::find(Auth::id());

        $new_v = [];

        foreach ($v->venues as $key => $value) {
            $new_v[$value->id] = $value->title;
        }

        $event->start_date = $this->dateFormatCalendarreverse($event->start_date);

        $args = [
            'event' => $event,
            'venues' => $new_v
        ];

        return view('umbooks::admin.models.event.edit', $args);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, $id)
    {
        $event = Event::find($id);

        $event->title      = $request->title;
        $event->slug       = SlugService::createSlug(Event::class, 'slug', $request->title, ['unique' => true]);
        $event->admin_id   = Auth::id();
        $event->start_date = $this->dateFormatCalendar($request->start_date);
        $event->freq       = $request->freq;
        $event->venue_id   = $request->venue_id;
        $event->byday      = json_encode($request->byday);
        $event->save();

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
        $event = Event::find($id);
        $event->delete();

        Session::flash('guardado', 'Eliminado correctamente');

        return back();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function dataList()
    {
        return Datatables::of(Event::query())
            ->addColumn('action', function ($event) {
                $button_edit = '<a href="' . URL::to("/") . '/admin/event/' . $event->id . '/edit   " class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';

                $button_delete =
                '<form method="post" action="event/' . $event->id . '">
                    ' . csrf_field() . '
                    <input name="_method" type="hidden" value="DELETE">

                    <button type="submit" class="btn btn-xs btn-danger">
                        <i class="glyphicon glyphicon-remove"></i> Delete
                    </button>
                </form>';

                return '<span style="display: inline-block;">' . $button_edit . '</span> <span style="display: inline-block;">' . $button_delete . '</span>';

            })->make(true);
    }

    /**
     * ordena los elementos de la fecha del fullcalendar (dd/mm/yyyy, H:i:s) => (yyyy-mm-dd, H:i:s)
     * @param $fecha
     * @return string
     */
    public function dateFormatCalendar($fecha)
    {
        $formato_A           = explode(' ', $fecha);
        $formato_B           = explode('/', $formato_A[0]);
        $fecha_inicio_evento = $formato_B[2] . '-' . $formato_B[1] . '-' . $formato_B[0] . ' ' . $formato_A[1] . ":00";

        return $fecha_inicio_evento;
    }

    /**
     * ordena los elementos de la fecha del fullcalendar (dd/mm/yyyy, H:i:s) => (yyyy-mm-dd, H:i:s)
     * @param $fecha
     * @return string
     */
    public function dateFormatCalendarreverse($fecha)
    {
        $formato_A = explode(' ', $fecha);
        $formato_B = explode('-', $formato_A[0]);
        $hour      = explode(":", $formato_A[1]);

        $fecha_inicio_evento = $formato_B[2] . '/' . $formato_B[1] . '/' . $formato_B[0] . ' ' . $hour[0] . ":" . $hour[1];

        return $fecha_inicio_evento;
    }

    public function eventDateBlocked()
    {
        return view('umbooks::admin.models.event.dateBlocked');
    }

    public function storeEventDateBlocked()
    {
    }

}
