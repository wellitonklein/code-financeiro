<?php

namespace CodeFin\Http\Controllers\Api;

use CodeFin\Criteria\WithDepthCategoriesCriteria;
use CodeFin\Http\Controllers\Controller;
use CodeFin\Repositories\Interfaces\CategoryExpenseRepository;

/**
 * Class BankAccountsController.
 *
 * @package namespace CodeFin\Http\Controllers;
 */
class CategoryExpensesController extends Controller
{

    use CategoriesControllerTrait;
    /**
     * @var BankAccountRepository
     */
    protected $repository;

    /**
     * BankAccountsController constructor.
     *
     * @param BankAccountRepository $repository

     */
    public function __construct(CategoryExpenseRepository $repository)
    {
        $this->repository = $repository;
        $this->repository->pushCriteria(new WithDepthCategoriesCriteria());
    }
}
