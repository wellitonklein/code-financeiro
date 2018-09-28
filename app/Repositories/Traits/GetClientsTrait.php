<?php

namespace CodeFin\Repositories\Traits;

use CodeFin\Repositories\Interfaces\ClientRepository;

trait GetClientsTrait{
    private function getClients(){
        $repository = app(ClientRepository::class);
        $repository->skipPresenter(true);
        return $repository->all();
    }
}