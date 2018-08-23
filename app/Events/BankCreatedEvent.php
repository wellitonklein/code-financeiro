<?php

namespace CodeFin\Events;

use CodeFin\Models\Bank;

class BankCreatedEvent
{
    private $bank;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Bank $bank)
    {
        $this->bank = $bank;
    }

    public function getBank(){
        return $this->bank;
    }

}
