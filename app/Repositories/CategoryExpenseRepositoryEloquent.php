<?php

namespace CodeFin\Repositories;

use CodeFin\Presenters\CategoryPresenter;
use CodeFin\Repositories\Interfaces\CategoryExpenseRepository;
use CodeFin\Repositories\Traits\CategoryRepositoryTrait;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFin\Models\CategoryExpense;

/**
 * Class CategoryRevenueRepositoryEloquent.
 *
 * @package namespace CodeFin\Repositories;
 */
class CategoryExpenseRepositoryEloquent extends BaseRepository implements CategoryExpenseRepository
{
    use CategoryRepositoryTrait;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return CategoryExpense::class;
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
