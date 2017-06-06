<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewPassword extends Mailable
{
    use Queueable, SerializesModels;
    protected $password_to_send;
    protected $confirmation_token;
    protected $password;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password_to_send,$password,$confirmation_token)
    {
        $this->password_to_send = $password_to_send;
        $this->password = $password;
        $this->confirmation_token = $confirmation_token;
        $this->url = 'http://etk21.ru/confirm-new-password/'. $confirmation_token . '/' . $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.send_new_account_password')                    
                    ->subject('Новый пароль от аккаунта')
                    ->with([
                        'password_to_send' => $this->password_to_send,
                        'password' => $this->password,
                        'url'    => $this->url
                        ]);;;
    }
}
