<?php

namespace App\Mail;

use \App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegEmail extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $url;
    protected $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $password, $register_token)
    {
        $this->email = $email;
        $this->password = $password;
        $this->url = 'http://etk21.ru/confirm-account/' . $register_token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.registration')
                    ->subject('Регистрация личного кабинета')
                    ->with([
                        'email' => $this->email,
                        'password' => $this->password,
                        'url'    => $this->url
                        ]);
    }
}
