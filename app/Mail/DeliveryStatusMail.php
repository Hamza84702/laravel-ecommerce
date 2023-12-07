<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class DeliveryStatusMail extends Mailable
{
    use Queueable, SerializesModels;
    public $deliverystatus;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($deliverystatus)
    {
        $this->deliverystatus = $deliverystatus;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('frontend.deliverystatusemail')->with(['deliverystatus' => $this->deliverystatus]);
    }
}
