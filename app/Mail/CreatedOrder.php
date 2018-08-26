<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreatedOrder extends Mailable
{
    use Queueable, SerializesModels;

    public $id;
    private $order;

    /**
     * CreatedOrder constructor.
     * @param $orderId
     * @param $order
     */
    public function __construct($orderId, $order)
    {
        $this->id = $orderId;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->order->listOrderDataForUser($this);

        return $this->from('domkanczap@gmail.com')
            ->view('emails.orders.created',[
                'order' => $data
            ]);

    }
}
