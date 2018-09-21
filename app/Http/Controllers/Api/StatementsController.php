<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Http\Controllers\Controller;
use CodeFin\Repositories\StatementRepository;

/**
 * Class BankAccountsController.
 *
 * @package namespace CodeFin\Http\Controllers;
 */
class StatementsController extends Controller
{
    /**
     * @var StatementRepository
     */
    protected $repository;

    /**
     * BankAccountsController constructor.
     *
     * @param StatementRepository $repository

     */
    public function __construct(StatementRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $statements = $this->repository->paginate(3);

        return $statements;
    }
}