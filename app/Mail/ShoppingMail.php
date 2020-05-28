<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShoppingMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order=[];
    public $orderdetail=[];
    public $customer;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order,$orderdetail,$customer)
    {
            $this->order=$order;
            $this->orderdetail=$orderdetail;               //
            $this->customer=$customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.email')->with('order',$this->order)->with('order_details',$this->orderdetail)->with('customer',$this->customer);
    }
}
