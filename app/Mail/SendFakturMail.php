<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendFakturMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pbks;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pbks)
    {
        $this->pbks = $pbks;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('sagoone.com@gmail.com')
                    ->subject('Mail From Sagoone.com')
                    ->view('faktur')
                    ->with([
                        'nama' => 'CV Podomoro Makassar',
                        'website' => 'www.sagoone.com',
                    ]);
    }
}
