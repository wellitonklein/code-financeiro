<?php

namespace CodeFin\Listeners;

use CodeFin\Events\BankCreatedEvent;
use CodeFin\Events\IuguSubscriptionCreatedEvent;
use CodeFin\Models\Subscription;
use CodeFin\Repositories\Interfaces\SubscriptionRepository;

class SubscriptionCreateListener
{
    private $repository;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SubscriptionRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  BankCreatedEvent  $event
     * @return void
     */
    public function handle(IuguSubscriptionCreatedEvent $event)
    {
        $iuguSubscriptiopn = $event->getIuguSubscription();
        $invoice = $iuguSubscriptiopn->recent_invoices[0];

        $this->repository->create([
            'expires_at' => $iuguSubscriptiopn->expires_at,
            'code' => $iuguSubscriptiopn->id,
            'user_id' => $event->getUserId(),
            'plan_id' => $event->getPlanId(),
            'status' => $invoice->status == 'paid' ? Subscription::STATUS_ATIVE : Subscription::STATUS_INATIVE
        ]);
    }
}
