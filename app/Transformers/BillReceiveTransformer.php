<?php

namespace CodeFin\Transformers;

use CodeFin\Models\BillReceive;
use League\Fractal\TransformerAbstract;

/**
 * Class CategoryTransformer.
 *
 * @package namespace CodeFin\Transformers;
 */
class BillReceiveTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['category','bankAccount'];

    /**
     * Transform the CategoryRevenue entity.
     *
     * @param \CodeFin\Models\CategoryExpense $model
     *
     * @return array
     */
    public function transform(BillReceive $model)
    {
        return [
            'id'          => (int) $model->id,

            'date_due'    => $model->date_due,
            'name'        => $model->name,
            'value'       => $model->value,
            'done'        => $model->done,
            'category_id' => (int) $model->category_id,
            'bank_account_id' => (int) $model->bank_account_id,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeCategory(BillReceive $model)
    {
        $transformer = new CategoryTransformer();
        $transformer->setDefaultIncludes([]);

        return $this->item($model->category, $transformer);
    }

    public function includeBankAccount(BillReceive $model)
    {
        return $this->item($model->bankAccount, new BankAccountTransformer());
    }
}