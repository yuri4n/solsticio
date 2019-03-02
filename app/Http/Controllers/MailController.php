<?php

namespace Solsticio\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\UserMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function send($request)
    {
        $objMail = new \stdClass();

        $objMail->aprovado1 = 'Desde Solsticio Parque Residencial Etapa 5 queremos informate que tu usuario ha sido aporvado y desde ahora podrás: ';
        $objMail->aprovado2 = 'Subir clasificados ofreciendo productos y servicios a la comunidad';
        $objMail->aprovado3 = 'Solicitar la participación en el sorteo de parqueaderos';
        $objMail->aprovado4 = 'Solicitar servicios como los salones comunales';
        $objMail->aprovado5 = 'Si eres Propietario, podrás leer los archivos de las juntas del consejo';

        $objMail->sender = $request->senderName;

        $objMail->receiver = $request->name;
        $objMail->receiverMail = $request->email;

        Mail::to($objMail->receiver)->send(new UserMail($objMail));
    }
}
