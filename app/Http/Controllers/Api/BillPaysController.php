<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Criteria\FindBetweenDateBRCriteria;
use CodeFin\Criteria\FindByValueBRCriteria;
use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Requests\BillPayRequest;
use CodeFin\Repositories\BillPayRepository;
use Illuminate\Http\Request;

/**
 * Class BankAccountsController.
 *
 * @package namespace CodeFin\Http\Controllers;
 */
class BillPaysController extends Controller
{
    /**
     * @var BillPayRepository
     */
    protected $repository;

    /**
     * BankAccountsController constructor.
     *
     * @param BillPayRepository $repository

     */
    public function __construct(BillPayRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $searchParam = config('repository.criteria.params.search');
        $search = $request->get($searchParam);
        $this->repository
            ->pushCriteria(new FindBetweenDateBRCriteria($search,'date_due'))
            ->pushCriteria(new FindByValueBRCriteria($search));
        $billPays = $this->repository->paginate(5);

        return $billPays;
    }

    public function store(BillPayRequest $request){
        $billPay = $this->repository->create($request->all());
        return response()->json($billPay, 201);
    }

    public function show($id){
        $billPay = $this->repository->find($id);

        return response()->json($billPay);
    }

    public function update(BillPayRequest $request, $id){
        $billPay = $this->repository->update($request->all(), $id);
        return response()->json($billPay);
    }

    public function destroy($id){
        $this->repository->delete($id);
        return response()->json([], 204);
    }

}
