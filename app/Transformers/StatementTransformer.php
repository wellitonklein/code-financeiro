<?php

namespace CodeFin\Transformers;

use CodeFin\Models\AbstractCategory;
use CodeFin\Models\Statement;
use League\Fractal\TransformerAbstract;

/**
 * Class CategoryTransformer.
 *
 * @package namespace CodeFin\Transformers;
 */
class StatementTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['bankAccount'];
    /**
     * Transform the CategoryRevenue entity.
     *
     * @param \CodeFin\Models\CategoryExpense $model
     *
     * @return array
     */
    public function transform(Statement $model)
    {
        return [
            'id'              => (int) $model->id,
            'date'            => $model->created_at->format('Y-m-d'),
            'value'           => $model->value,
            'balance'         => $model->balance,
            'bank_account_id' => (int)$model->bank_account_id,
        ];
    }

    public function includeBankAccount(Statement $model)
    {
        return $this->item($model->bankAccount, new BankAccountTransformer());
    }
}
