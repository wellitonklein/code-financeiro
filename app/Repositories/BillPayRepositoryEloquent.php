<?php

namespace CodeFin\Repositories;

use CodeFin\Models\BillPay;
use CodeFin\Presenters\BillPresenter;
use CodeFin\Repositories\Interfaces\BillPayRepository;
use CodeFin\Repositories\Traits\BillRepositoryTrait;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class BillPayRepositoryEloquent
 * @package namespace CodeFin\Repositories;
 */
class BillPayRepositoryEloquent extends BaseRepository implements BillPayRepository
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
        return BillPay::class;
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
