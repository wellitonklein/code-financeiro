<?php

namespace CodeFin\Listeners;

use CodeFin\Events\BankStoredEvent;
use CodeFin\Models\Bank;
use CodeFin\Repositories\BankRepository;

class BankLogoUploadListener
{
    private $repository;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(BankRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle the event.
     *
     * @param  BankStoredEvent  $event
     * @return void
     */
    public function handle(BankStoredEvent $event)
    {
        $bank = $event->getBank();
        $logo = $event->getLogo();

        $name = md5(time()).'.'.$logo->guessExtension();
        $destFile = Bank::logosDir();

        \Storage::disk('public')->putFileAs($destFile,$logo,$name);

        $this->repository->update(['logo' => $name], $bank->id);
    }
}
