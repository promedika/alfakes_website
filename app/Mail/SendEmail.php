<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->markdown('sendmail')
            ->subject($this->data["subject"])
            ->with('data', $this->data);
            // ->attach(public_path('/img/a.png'), [
            //     'as'    => 'a.png',
            //     'mime'  => 'image/png',
            // ]);
        return $data;
    }
}
