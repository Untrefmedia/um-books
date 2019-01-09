<?php

namespace Untrefmedia\UMBooks\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function form()
    {
        return view('umbooks::models.book.collection');
    }
}
