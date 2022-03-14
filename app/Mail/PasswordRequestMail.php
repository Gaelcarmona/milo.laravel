<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PasswordRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    /**
     * Create a new message instance.
     *
     * @param $order
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     *
     */
    public function build()
    {
//        return $this->subject('Confirmation de réservation (catalogue)')->view('emails.order.newClient',['order' => $this->order]);
        return $this->subject('Confirmation de réservation (catalogue)')->view('emails.order.newClient',['order' => $this->order]);
    }
}
