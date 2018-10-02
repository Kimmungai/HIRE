<?php

namespace App\Mail;
use App\User;
use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOrder extends Mailable
{
    use Queueable, SerializesModels;
    protected $company;
    protected $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $company, Order $order)
    {
        $this->company=$company;
        $this->order=$order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company=$this->company;
        $order=$this->order;
        return $this->view('emails.new-order',compact('company','order'));
    }
}
