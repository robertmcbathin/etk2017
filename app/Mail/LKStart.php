<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LKStart extends Mailable
{
    use Queueable, SerializesModels;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->url = 'https://etk21.ru/register';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.distribution.lkstart')
                    ->subject('Личный кабинет держателя карты ЕТК')
                    ->with([
                        'url' => $this->url
                    ]);
    }
}
