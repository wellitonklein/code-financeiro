<?php

namespace CodeFin\Events;

use CodeFin\Models\BankAccount;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BankAccountBalanceUpdatedEvent implements ShouldBroadcast
{
    public $bankAccount;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(BankAccount $bankAccount)
    {
        $this->bankAccount = $bankAccount;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return new PrivateChannel("client.{$this->bankAccount->client_id}");
    }
}
