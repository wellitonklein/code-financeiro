<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Criteria\FindBetweenDateBRCriteria;
use CodeFin\Http\Controllers\Controller;
use CodeFin\Repositories\Interfaces\StatementRepository;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {
        $searchParam = config('repository.criteria.params.search');
        $search = $request->get($searchParam);
        $this->repository
            ->pushCriteria(new FindBetweenDateBRCriteria($search, 'created_at'));
        $statements = $this->repository->paginate(3);

        return $statements;
    }
}
