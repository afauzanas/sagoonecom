<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEnotaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pbts;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pbts)
    {
        $this->pbts = $pbts;
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
                    ->view('enota')
                    ->with([
                        'nama' => 'CV Podomoro Makassar',
                        'website' => 'www.sagoone.com',
                    ]);
    }
}
