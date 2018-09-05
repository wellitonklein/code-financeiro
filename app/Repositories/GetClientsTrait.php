<?php

namespace CodeFin\Repositories;

trait GetClientsTrait{
    private function getClients(){
        $repository = app(ClientRepository::class);
        $repository->skipPresenter(true);
        return $repository->all();
    }
}