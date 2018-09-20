<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Criteria\FindBetweenDateBRCriteria;
use CodeFin\Criteria\FindByValueBRCriteria;
use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Requests\BillReceiveRequest;
use CodeFin\Repositories\BillReceiveRepository;
use Illuminate\Http\Request;

/**
 * Class BankAccountsController.
 *
 * @package namespace CodeFin\Http\Controllers;
 */
class BillReceivesController extends Controller
{
    /**
     * @var BankAccountRepository
     */
    protected $repository;

    /**
     * BankAccountsController constructor.
     *
     * @param BankAccountRepository $repository

     */
    public function __construct(BillReceiveRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $searchParam = config('repository.criteria.params.search');
        $search = $request->get($searchParam);
        $this->repository
            ->pushCriteria(new FindBetweenDateBRCriteria($search))
            ->pushCriteria(new FindByValueBRCriteria($search));
        $billPays = $this->repository->paginate(5);

        return $billPays;
    }

    public function store(BillReceiveRequest $request){
        $billPay = $this->repository->create($request->all());
        return response()->json($billPay, 201);
    }

    public function show($id){
        $billPay = $this->repository->find($id);

        return response()->json($billPay);
    }

    public function update(BillReceiveRequest $request, $id){
        $billPay = $this->repository->update($request->all(), $id);
        return response()->json($billPay);
    }

    public function destroy($id){
        $this->repository->delete($id);
        return response()->json([], 204);
    }

}
