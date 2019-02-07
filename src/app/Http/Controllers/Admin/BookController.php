<?php

namespace Untrefmedia\UMBooks\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RRule\RRule;
use Session;
use Untrefmedia\UMBooks\App\Book;
use Untrefmedia\UMBooks\App\Event;
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
            $inicioEvento = $fecha_inicio_evento;
        } else {
            $inicioEvento = null;
        }

        if (! is_null($fecha_fin_evento) && $fecha_fin_evento != 'null') {
            $finEvento = $fecha_fin_evento;
        } else {
            $finEvento = null;

        }

        $detalles = json_encode($request->values);

        $book = new Book();

        $book->venue_id         = $request->values['venue_id'];
        $book->event_date_start = $this->dateFormatCalendar($inicioEvento);
        $book->event_date_end   = $this->dateFormatCalendar($finEvento);
        $book->detail           = $detalles;
        $book->save();

        Session::flash('guardado', 'creado correctamente');

        return 'true';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $book = Book::find($id);

        $args = [
            'book'   => $book,
            'detail' => json_decode($book->detail)
        ];

        // dd($args);

         return view('umbooks::admin.models.book.view', $args);

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
     * Data para listado en administrador
     * @return mixed
     * @throws \Exception
     */
    public function dataList()
    {
        return Datatables::of(Book::query())
            ->addColumn('action', function ($book) {
                switch ($book->status) {
                    case 1:
                        $button_confirm =
                        '<form method="post" action="' . URL::to('admin/emailBook') . '">
                        ' . csrf_field() . '

                        <input type="hidden" name="id" value="' . $book->id . '">

                        <button type="submit" class="btn btn-xs btn-success">
                        <i class="glyphicon glyphicon-check"></i> Confirm
                        </button>
                        </form>';
                        break;

                    case 2:
                        $button_confirm =
                        '<form method="post" action="' . URL::to('admin/cancelBook') . '">
                        ' . csrf_field() . '

                        <input type="hidden" name="id" value="' . $book->id . '">

                        <button type="submit" class="btn btn-xs btn-warning">
                        <i class="glyphicon glyphicon-check"></i> Cancel
                        </button>
                        </form>';
                        break;

                    default:
                        $button_confirm = '';
                        break;
                }

                
                $button_view =
                '<a href="' . URL::to('admin/book/' . $book->id) . '" class="btn btn-xs btn-primary">
                    <i class="glyphicon glyphicon-edit"></i> Ver
                </a>';
                
                $button_edit =
                '<a href="' . URL::to('admin/book/' . $book->id . '/edit') . '" class="btn btn-xs btn-primary">
                    <i class="glyphicon glyphicon-edit"></i> Edit
                </a>';

                $button_delete =
                '<form method="post" action="book/' . $book->id . '">
                    ' . csrf_field() . '
                    <input name="_method" type="hidden" value="DELETE">

                    <button type="submit" class="btn btn-xs btn-danger">
                        <i class="glyphicon glyphicon-remove"></i> Delete
                    </button>
                </form>';

                return '<span style="display: inline-block;">' . $button_confirm . '</span>
                        <span style="display: inline-block;">' . $button_delete . '</span>
                        <span style="display: inline-block;">' . $button_view. '</span>';

            })->make(true);
    }

    /**
     * Revisa si un turno está disponible segun la capacidad del venue
     * @param Request $request
     * @return mixed
     */
    public function availabilityBook(Request $request)
    {
        $fecha_elegida  = $request->start;
        $venue_id       = $request->venue;
        $disponibilidad = 'lleno';

        $cantidad_maxima_de_grupos = Venue::where('id', $venue_id)->select('quantity_group')->get()->first()->quantity_group;

        $fecha_inicio_evento = date('Y-m-d H:i:s', strtotime($this->dateFormatCalendar($fecha_elegida)));

        $cantidad_de_reservas = Book::where('event_date_start', $fecha_inicio_evento)->count();

        if ($cantidad_de_reservas < $cantidad_maxima_de_grupos) {
            $disponibilidad = 'disponible';
        }

        $capacidad_turno_disponible = $this->getCapacityTurn($venue_id, $fecha_elegida);

        $respuesta = [
            'disponibilidad'             => $disponibilidad,
            'capacidad_turno_disponible' => $capacidad_turno_disponible

        ];

        return $respuesta;
    }

    /**
     * Devuelve los turnos llenos
     * @param Request $request
     * @return array
     */
    public function datesNotAvailability($id_venue)
    {
        $cantidad_maxima_de_grupos = Venue::where('id', $id_venue)->select('quantity_group')->get()->first()->quantity_group;

        $turnos_no_disponibles = Book::where('venue_id', $id_venue)
            ->groupBy('event_date_start')
            ->havingRaw('COUNT(event_date_start) >= ' . $cantidad_maxima_de_grupos)
            ->select('event_date_start')
            ->get()
            ->pluck('event_date_start');

        $fechas = array();

        foreach ($turnos_no_disponibles as $key => $value) {
            $fechas[$key] = date('Y/m/d H:i:s', strtotime($value));
        }

        $key_no_disponibles = count($fechas);

        $fechas_bloqueadas = Event::where('type', 2) //[1: evento, 2: fechas bloqueadas]
        ->where('venue_id', $id_venue)
        ->select('start_date')
        ->get()
        ->pluck('start_date');

        foreach ($fechas_bloqueadas as $key => $value) {
            $fechas[$key_no_disponibles + $key] = date('Y/m/d H:i:s', strtotime($value));
        }

        return $fechas;
    }

    /**
     * Lista de eventos para el calendario
     * @param $venueId
     * @return json
     */
    public function getEvents(Request $request)
    {
        $venue_id              = $request->venueId;
        $fechas_no_disponibles = $this->datesNotAvailability($venue_id);
        $eventos               = array();
        $clave                 = 0;

        $events = Event::where('venue_id', $venue_id)
            ->where('type', 1) //[1: evento, 2:fecha bloqueada]
            ->select('title', 'start_date', 'byday', 'freq')
            ->get();

        foreach ($events as $key => $event) {
            $rrule = new RRule([
                'FREQ'     => $event->freq,
                'INTERVAL' => 1,
                'DTSTART'  => $event->start_date,
                'BYDAY'    => json_decode($event->byday),
                'UNTIL'    => date('Y-m-d H:i:s', strtotime('+1 years', strtotime($event->start_date)))
            ]);

            foreach ($rrule as $key => $occurrence) {
                $inicio = $occurrence->format('Y/m/d H:i:s');

                if (! in_array($inicio, $fechas_no_disponibles)) {
                    $eventos[$clave]['title'] = $event->title;
                    $eventos[$clave]['start'] = $inicio;
                    $eventos[$clave]['end']   = date('Y/m/d H:i:s', strtotime('+1 hours', strtotime($inicio)));

                    ++$clave;
                }

            }

        }

        return response()->json($eventos);
    }

    /**
     * Devuelve la cantidad de personas que pueden ocupar un turno
     * @param Request $request
     * @return int
     */
    public function getCapacityTurn($id_venue, $fecha_elegida)
    {
        $maximo_personas_por_turno = Venue::where('id', $id_venue)->select('capacity_turn')->get()->first()->capacity_turn;

        $lugares_disponibles = $maximo_personas_por_turno;

        $fechas              = explode('|', $fecha_elegida);
        $fecha_inicio_evento = $fechas[0];

        if (! is_null($fecha_inicio_evento) && $fecha_inicio_evento != 'null') {
            $inicioEvento = $this->dateFormatCalendar($fecha_inicio_evento);
        } else {
            $inicioEvento = null;
        }

        $reservas_en_fecha_elegida = Book::where('venue_id', $id_venue)
            ->where('event_date_start', $inicioEvento)
            ->select('detail')
            ->get()
            ->pluck('detail');

        if ($reservas_en_fecha_elegida->isNotEmpty()) {
            $detalles                     = json_decode($reservas_en_fecha_elegida);
            $contador_personas_reservadas = 0;

            foreach ($detalles as $key => $value) {
                $array_detalles = json_decode($value);
                $contador_personas_reservadas += $array_detalles->numberOfGroupMembers;
            }

            $lugares_disponibles -= $contador_personas_reservadas;

        }

        return $lugares_disponibles;
    }

    /**
     * Cancela una reserva
     * @param Request $request
     * @return request
     */
    public function cancelbook(Request $request)
    {
        $book = Book::find($request->id);

        $book->status = 1;
        $book->save();

        return back();
    }

    /**
     * ordena los elementos de la fecha del fullcalendar (dd/mm/yyyy, H:i:s) => (yyyy-mm-dd, H:i:s)
     * @param $fecha
     * @return string
     */
    public function dateFormatCalendar($fecha)
    {
        $formato_A           = explode(', ', $fecha);
        $formato_B           = explode('/', $formato_A[0]);
        $fecha_inicio_evento = $formato_B[2] . '-' . $formato_B[1] . '-' . $formato_B[0] . ' ' . $formato_A[1];

        return $fecha_inicio_evento;
    }

}
