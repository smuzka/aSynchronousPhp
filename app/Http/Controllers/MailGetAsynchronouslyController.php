<?php

namespace App\Http\Controllers;

use App\Mail\MyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailGetAsynchronouslyController extends Controller
{
    public function __invoke() {

        for ($i = 0; $i < 10; $i += 1) {
            \App\Jobs\SendMail::dispatch();
        }

        return 0;
    }
}
