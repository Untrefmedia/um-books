<?php

namespace Untrefmedia\UMBooks\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Session;
use Untrefmedia\UMBooks\App\Book;
use Untrefmedia\UMBooks\App\Http\Requests\BookRequest;
use URL;
use Yajra\Datatables\Datatables;

class BookController extends Controller
{
    public function test()
    {
        echo 555;
    }

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
            $inicioEvento = Carbon::createFromFormat('D M d Y H:i:s e+', $fecha_inicio_evento);
        } else {
            $inicioEvento = null;
        }

        if (! is_null($fecha_fin_evento) && $fecha_fin_evento != 'null') {
            $finEvento = Carbon::createFromFormat('D M d Y H:i:s e+', $fecha_fin_evento);
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

}
