<?php

namespace CodeFin\Repositories;

use CodeFin\Models\CategoryRevenue;
use CodeFin\Presenters\CategoryPresenter;
use CodeFin\Repositories\Interfaces\CategoryRevenueRepository;
use CodeFin\Repositories\Traits\CategoryRepositoryTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;

/**
 * Class CategoryRevenueRepositoryEloquent.
 *
 * @package namespace CodeFin\Repositories;
 */
class CategoryRevenueRepositoryEloquent extends BaseRepository implements CategoryRevenueRepository
{
    use CategoryRepositoryTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryRevenue::class;
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
        return CategoryPresenter::class;
    }

}
