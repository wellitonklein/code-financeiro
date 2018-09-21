<?php

namespace CodeFin\Http\Controllers\Api;

use Carbon\Carbon;
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
        $bankAccounts = $this->repository->paginate();

        return $bankAccounts;
    }

    public function listCashFlow(){
        $dateStart = new Carbon('2018-09-01');
        $dateEnd = $dateStart->copy()->addMonths(10);

        return $this->repository->getCashFlow($dateStart,$dateEnd);
    }
}
