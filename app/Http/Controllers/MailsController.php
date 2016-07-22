<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Mail;

class MailsController extends Controller
{
  public function sendMail()
  {
    $data = array(
        'name' => "SIMK Email",
    );
    //
    Mail::send('emails.register', $data, function ($message) {

        $message->from('simk.noreply@domain.com', 'Registration Laravel');

        $message->to('darma.kotama@gmail.com')->subject('Learning Laravel test email');

    });

    return "VERCONTOLAN";
  }
}
