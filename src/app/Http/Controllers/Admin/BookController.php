<?php

namespace Untrefmedia\UMBooks\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RRule\RRule;
use Session;
use Untrefmedia\UMBooks\App\Book;
use Untrefmedia\UMBooks\App\Http\Requests\BookRequest;
use Untrefmedia\UMBooks\App\Venue;
use URL;
use Yajra\Datatables\Datatables;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('umbooks::admin.models.book.collection');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('umbooks::admin.models.book.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $fechas              = explode('|', $request->values['selectedEvent']);
        $fecha_inicio_evento = $fechas[0];
        $fecha_fin_evento    = $fechas[1];

        if (! is_null($fecha_inicio_evento) && $fecha_inicio_evento != 'null') {
            $inicioEvento = date('Y-d-m H:i:s', strtotime($fecha_inicio_evento));
        } else {
            $inicioEvento = null;
        }

        if (! is_null($fecha_fin_evento) && $fecha_fin_evento != 'null') {
            $finEvento = date('Y-d-m H:i:s', strtotime($fecha_fin_evento));

        } else {
            $finEvento = null;

        }

        $detalles = json_encode($request->values);

        $book = new Book();

        $book->venue_id         = $request->values['venue_id'];
        $book->event_date_start = $inicioEvento;
        $book->event_date_end   = $finEvento;
        $book->detail           = $detalles;
        $book->save();

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
        $book = Book::find($id);

        $args = [
            'book' => $book
        ];

        return view('umbooks::admin.models.book.edit', $args);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {
        $book = Book::find($id);

        $book->title = $request->title;
        $book->save();

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
        $book = Book::find($id);
        $book->delete();

        Session::flash('guardado', 'Eliminado correctamente');

        return back();
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function dataList()
    {
        return Datatables::of(Book::query())
            ->addColumn('action', function ($book) {
                $button_edit = '<a href="' . URL::to("/") . '/admin/book/' . $book->id . '/edit   " class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Edit</a>';

                $button_delete =
                '<form method="post" action="book/' . $book->id . '">
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
     * Revisa si un turno está disponible segun la capacidad del venue
     * @param Request $request
     */
    public function availabilityBook(Request $request)
    {
        $respuesta = 'lleno';

        $cantidad_maxima_de_grupos = Venue::where('id', $request->venue)->select('quantity_group')->get()->first()->quantity_group;
        $fecha_inicio_evento       = date('Y-d-m H:i:s', strtotime($request->start));
        $cantidad_de_reservas      = Book::where('event_date_start', $fecha_inicio_evento)->count();

        if ($cantidad_de_reservas < $cantidad_maxima_de_grupos) {
            $respuesta = 'disponible';
        }

        return $respuesta;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function datesNotAvailability(Request $request)
    {
        $cantidad_maxima_de_grupos = Venue::where('id', $request->venue)->select('quantity_group')->get()->first()->quantity_group;

        $turnos_no_disponibles = Book::where('venue_id', $request->venue)
            ->groupBy('event_date_start')
            ->havingRaw('COUNT(event_date_start) >= ' . $cantidad_maxima_de_grupos)
            ->select('event_date_start')
            ->get()
            ->pluck('event_date_start');

        $fechas = array();

        foreach ($turnos_no_disponibles as $key => $value) {
            $fechas[$key] = date('Y-d-m H:i:s', strtotime($value));
            $formato_A    = explode(' ', $value);
            $formato_B    = explode('-', $formato_A[0]);

            $formateada   = $formato_B[2] . '/' . $formato_B[1] . '/' . $formato_B[0] . ', ' . $formato_A[1];
            $fechas[$key] = $formateada;
        }

        $arr = array(
            "events" => $fechas,
            "status" => true
        );

        return response()->json($arr);
    }

    public function getEvents()
    {
        $rrule = new RRule([
            'FREQ'     => 'WEEKLY',
            'INTERVAL' => 1,
            'DTSTART'  => '2019-01-01 10:00:00',
            'BYDAY'    => ['MO', 'TU', 'WE', 'TH', 'FR'],
            'UNTIL'    => '2020-01-01 10:00:00'
            // 'COUNT'    => 100
        ]);

        $eventos = array();

        foreach ($rrule as $key => $occurrence) {
            $eventos[$key]['title'] = 'Desde las 10';
            $eventos[$key]['start'] = $occurrence->format('Y/m/d H:i:s');
            $eventos[$key]['end']   = date('Y/m/d H:i:s', strtotime('+1 hours', strtotime($eventos[$key]['start'])));
        }

        return response()->json($eventos);
    }

    /**
     * @param Request $request
     */
    public function checkCapacityTurn(Request $request)
    {
        $fechas              = explode('|', $request->turnoElegido);
        $fecha_inicio_evento = $fechas[0];

        if (! is_null($fecha_inicio_evento) && $fecha_inicio_evento != 'null') {
            $inicioEvento = date('Y-d-m H:i:s', strtotime($fecha_inicio_evento));
        } else {
            $inicioEvento = null;
        }

        $maximo_personas_por_turno = Venue::where('id', $request->venue)->select('capacity_turn')->get()->first()->capacity_turn;

        $reservas_en_fecha_elegida = Book::where('venue_id', $request->venue)
            ->where('event_date_start', $inicioEvento)
            ->select('detail')
            ->get()
            ->pluck('detail');

        if ($reservas_en_fecha_elegida->isNotEmpty()) {
            $detalles = json_decode($reservas_en_fecha_elegida);
            print_r($detalles[0]);
        }

        return response()->json($reservas_en_fecha_elegida);
    }

}
