<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BalanceUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $balance;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($balance)
    {
        $this->balance = $balance;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('homepage');
    }

    public function broadcastWith()
    {
        if($this->balance->paymentamount){
            return [
                'paymentamount' => $this->balance->paymentamount,
            ];
        }else if($this->balance->partial){
            return [
                'partial' => $this->balance->partial,
            ];
        }else{
            return [
                'amount' => $this->balance->amount,
            ];
        }
        
    }

}
