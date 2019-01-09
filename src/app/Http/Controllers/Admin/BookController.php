<?php

namespace Untrefmedia\UMBooks\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Untrefmedia\UMBooks\App\Book;
use Untrefmedia\UMBooks\App\Http\Requests\BookRequest;
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
        $book = new Book();

        $book->title = $request->title;
        $book->slug  = SlugService::createSlug(Book::class, 'slug', $request->title, ['unique' => true]);
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
