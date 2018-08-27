<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Repositories\BankRepository;
use CodeFin\Http\Controllers\Controller;

class BanksController extends Controller
{
    private $repository;

    public function __construct(BankRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        return $this->repository->all();
    }
}