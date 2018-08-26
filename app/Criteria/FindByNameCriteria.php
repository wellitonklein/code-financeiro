<?php

namespace CodeFin\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class FindByNameCriteria.
 *
 * @package namespace CodeFin\Criteria;
 */
class FindByNameCriteria implements CriteriaInterface
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $queryBuilder = $model->where('name','=',$this->name);
        return $queryBuilder;
    }
}
