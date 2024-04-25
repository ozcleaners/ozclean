<?php

namespace App\Mail;
use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $subject;
    public $iscc;

    public function __construct($data, $subject, $cc_emails)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->cc_emails = $cc_emails;
    }

    public function build()
    {
        if ($this->cc_emails == true) {
            $exForCC = explode(' | ', $getSettingMailAddress);
        } else {
            $exForCC = [];
        }
        $exForBCC = ['emran_haidar@yahoo.com'];

        //dd($this->data[0]['site_id']);
        //dd($this->data['message']);
        $address = 'info@ozcleaners.com.au';
        $subject = $this->subject;
        $name = 'Oz Cleaners';
        $messages = [
            'attachment' => true,
        ];
        $messages = array_merge($messages, $this->data); //Pull Array data ['template', 'code', 'message]
        $template = $messages['template'];
        //$file_name = $subject;
        //$mail_path= public_path().'/'.$subject.'.xlsx';
        $pdf = PDF::loadView($template, compact('messages'));
        if($messages['attachment']) {
            return $this->view($template, compact('messages'))
                ->attachData($pdf->output(), "invoice.pdf")
                ->from($address, $name)
                ->cc($exForCC, $name)
                ->bcc($exForBCC, $name.'-Customer has been recieved an email')
                //->replyTo($address, $name)
                ->subject($subject);
        }else {
            return $this->view($template, compact('messages'))
                ->from($address, $name)
                ->cc($exForCC, $name)
                ->bcc($exForBCC, $name.'-Customer has been recieved an email')
                //->replyTo($address, $name)
                ->subject($subject);
        }
    }
}
