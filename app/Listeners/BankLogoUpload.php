<?php

namespace CodeFin\Listeners;

use CodeFin\Events\BankCreatedEvent;

class BankLogoUpload
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BankCreatedEvent  $event
     * @return void
     */
    public function handle(BankCreatedEvent $event)
    {
        echo "Listener exec";
    }
}
