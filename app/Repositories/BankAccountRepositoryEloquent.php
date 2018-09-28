<?php

namespace CodeFin\Repositories;

use CodeFin\Criteria\FindByNameCriteria;
use CodeFin\Criteria\LockTableCriteria;
use CodeFin\Events\BankAccountBalanceUpdatedEvent;
use CodeFin\Models\Bank;
use CodeFin\Presenters\BankAccountPresenter;
use CodeFin\Presenters\BankPresenter;
use CodeFin\Repositories\Interfaces\BankAccountRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFin\Models\BankAccount;

/**
 * Class BankAccountRepositoryEloquent.
 *
 * @package namespace CodeFin\Repositories;
 */
class BankAccountRepositoryEloquent extends BaseRepository implements BankAccountRepository
{

    protected $fieldSearchable = [
        'name' => 'like',
        'agency' => 'like',
        'account' => 'like',
        'bank.name' => 'like'
    ];

    public function addBalance($id, $value)
    {
        $skipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        \DB::beginTransaction();
        $this->pushCriteria(new LockTableCriteria());
        $model = $this->find($id);
        $model->balance = $model->balance + $value;
        $model->save();
        \DB::commit();
        if (!app()->runningInConsole()){
            broadcast(new BankAccountBalanceUpdatedEvent($model));
        }
        $this->popCriteria(LockTableCriteria::class);
        $this->skipPresenter = $skipPresenter;

        return $model;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BankAccount::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return BankAccountPresenter::class;
    }
}
