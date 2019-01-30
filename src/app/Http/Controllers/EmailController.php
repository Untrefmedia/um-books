<?php

namespace Untrefmedia\UMBooks\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Untrefmedia\UMBooks\App\Book;
use Untrefmedia\UMBooks\App\Venue;

class EmailController extends Controller
{
    /**
     * Envia un email cuado confirman la reserva desde el administrador
     * @param Request $request
     * @return mixed
     */
    public function SendMailBook(Request $request)
    {
        $book     = Book::find($request->id);
        $venue    = Venue::find($book->venue_id);
        $detalles = json_decode($book->detail);

        $token   = md5(microtime());
        $toUser  = array($detalles->institution_email, $detalles->teacher_email);
        $message = array();

        Mail::send('umbooks::email.book', ['token' => $token, 'toUser' => $toUser, 'venue' => $venue], function ($message) use ($token, $toUser, $venue) {
            $message->from(env('MAIL_FROM_ADDRESS'), $venue->title);
            $message->to($toUser, $venue->title)->subject('Reserva en ' . $venue->title);
        });

        // Actualiza el estado de la reserva a confirmada
        $book->status = 2;
        $book->save();

        return back();
    }
}
