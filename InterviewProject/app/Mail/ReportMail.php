<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $products;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($products)
    {
        $this->products = $products;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = 'orders.stats@gmail.com';
        return $this->from($email, 'Report')->to('alexander@webscribble.com')->cc($email)->subject('Order Report')->view('emails.report');
    }
}
