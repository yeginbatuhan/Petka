<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UserPass extends Mailable
{
    use Queueable, SerializesModels;
  public $user;
  public $password;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$password)
    {
        $this->user=$user;
        $this->password=$password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
          ->subject(config('app.name'). ' - Sisteme Giriş Bilgileriniz')
          ->view('mails.user-password-mail');
    }
}
