<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportReady extends Mailable
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
        $this->url = 'https://etk21.ru/profile/details-history';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.report_ready')
                    ->subject('Отчет по Вашей карте готов')
                    ->with([
                        'url' => $this->url
                    ]);
    }
}
