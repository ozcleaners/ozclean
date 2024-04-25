<?php

namespace App\Helpers;

use App\Mail\SendMail;
use Mail;

//use Maatwebsite\Excel\Facades\Excel;
//use \App\Exports\MailAttachment;

class MailHelper
{
    public static function send($data, $subject, $address, $cc_emails = true)
    {
        Mail::to($address)->send(new SendMail($data, $subject, $cc_emails));
    }
}
