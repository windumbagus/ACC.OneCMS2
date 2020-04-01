<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailAccCashRejectStnkExp extends Mailable
{
    use Queueable, SerializesModels;

    public $data_mail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_mail)
    {
        $this->data_mail = $data_mail;
        $this->nopol = $data_mail["NO_CAR_POLICE"];
        $this->nominal = $data_mail["DISBURSEMENT"];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.mail_acc_cash_reject_stnkexp')
        ->subject("Pengajuan Sebesar Rp".$this->nominal." dari Unit ".$this->nopol." Ditolak");
    }
}
