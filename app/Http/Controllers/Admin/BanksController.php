<?php

namespace CodeFin\Http\Controllers\Admin;

use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Controllers\Response;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CodeFin\Http\Requests\BankCreateRequest;
use CodeFin\Http\Requests\BankUpdateRequest;
use CodeFin\Repositories\BankRepository;

/**
 * Class BanksController.
 *
 * @package namespace CodeFin\Http\Controllers;
 */
class BanksController extends Controller
{
    /**
     * @var BankRepository
     */
    protected $repository;

    /**
     * BanksController constructor.
     *
     * @param BankRepository $repository
     * @param BankValidator $validator
     */
    public function __construct(BankRepository $repository)
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
        $banks = $this->repository->paginate(7);

//        if (request()->wantsJson()) {
//
//            return response()->json([
//                'data' => $banks,
//            ]);
//        }

        return view('admin.banks.index', compact('banks'));
    }

    public function create()
    {
        return view('admin.banks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BankCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BankCreateRequest $request)
    {
        $data = $request->all();
        $data['logo'] = md5(time().'.jpeg');
        $this->repository->create($data);

        return redirect()->route('admin.banks.index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = $this->repository->find($id);

        return view('admin.banks.edit', compact('bank'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BankUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BankUpdateRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);

        return redirect()->route('admin.banks.index');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Bank deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Bank deleted.');
    }
}
