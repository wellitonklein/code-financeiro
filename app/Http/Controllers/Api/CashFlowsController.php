<?php

namespace CodeFin\Http\Controllers\Api;

use Carbon\Carbon;
use CodeFin\Http\Controllers\Controller;
use CodeFin\Repositories\Interfaces\StatementRepository;

/**
 * Class BankAccountsController.
 *
 * @package namespace CodeFin\Http\Controllers;
 */
class CashFlowsController extends Controller
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
        $dateStart = new Carbon('2018-10-01');
        $dateEnd = $dateStart->copy()->addMonths(10);

        return $this->repository->getCashFlow($dateStart,$dateEnd);
    }

    public function byPeriod()
    {
        $dateStart = new Carbon();
        $dateEnd = $dateStart->copy()->addDays(30);

        return $this->repository->getCashFlowByPeriod($dateStart, $dateEnd);
    }
}
