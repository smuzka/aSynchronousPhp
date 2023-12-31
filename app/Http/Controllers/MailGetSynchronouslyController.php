<?php

namespace App\Http\Controllers;

use App\Mail\MyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailGetSynchronouslyController extends Controller
{
    public function __invoke() {
        for ($i = 0; $i < 10; $i += 1) {
            Mail::to("jakub1smuga@gmail.com")->send(new myEmail());
            \App\Events\sendMailEvent::dispatch("Ok");
        }
        return 0;
    }
}
