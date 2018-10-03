<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order;
use App\User;
class BidAccepted extends Mailable
{
    use Queueable, SerializesModels;
    protected $order;
    protected $company;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order, User $company)
    {
        $this->order=$order;
        $this->company=$company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $order = $this->order;
        $company = $this->company;
        return $this->view('emails.bid-accepted',compact('order','company'));
    }
}
