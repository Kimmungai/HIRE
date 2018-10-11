<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Order;

class orderSuspended extends Mailable
{
    use Queueable, SerializesModels;
    protected $user;
    protected $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Order $order)
    {
      $this->user=$user;
      $this->order=$order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $user=$this->user;
      $order=$this->order;
      return $this->from('info@ths.com', '東京ハイヤークラブ')->view('emails.order-suspended',compact('user','order'));
    }
}
