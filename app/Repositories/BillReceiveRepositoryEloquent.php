<?php

namespace CodeFin\Repositories;

use CodeFin\Models\BillReceive;
use CodeFin\Presenters\BillPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class BankRepositoryEloquent.
 *
 * @package namespace CodeFin\Repositories;
 */
class BillReceiveRepositoryEloquent extends BaseRepository implements BillReceiveRepository
{
    use BillRepositoryTrait;

    protected $fieldSearchable = [
        'name' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BillReceive::class;
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
        return BillPresenter::class;
    }

}
