<?php

namespace CodeFin\Repositories\Interfaces;

use Prettus\Repository\Contracts\RepositoryCriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface BankAccountRepository.
 *
 * @package namespace CodeFin\Repositories;
 */
interface BankAccountRepository extends RepositoryInterface, RepositoryCriteriaInterface
{
    public function addBalance($id, $value);
}
