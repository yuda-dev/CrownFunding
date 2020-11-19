<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mail\UserRegisterMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailOtpCode implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event->condition == 'register') {
            $pesan = "Selamat anda sudah terdaftar, silahkan copy kode OTP dibawah ini untuk verifikasi akun anda..";
        } elseif ($event->condition == 'regenerate') {
            $pesan = "Regenerate berhasil, Berikut kode OTP Anda !";
        }

        Mail::to($event->user)->send(new UserRegisterMail($event->user, $pesan));
    }
}
