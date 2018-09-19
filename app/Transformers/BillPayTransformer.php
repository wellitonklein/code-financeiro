<?php

namespace CodeFin\Transformers;

use CodeFin\Models\BillPay;
use League\Fractal\TransformerAbstract;

/**
 * Class CategoryTransformer.
 *
 * @package namespace CodeFin\Transformers;
 */
class BillPayTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['category','bankAccount'];

    /**
     * Transform the CategoryRevenue entity.
     *
     * @param \CodeFin\Models\CategoryExpense $model
     *
     * @return array
     */
    public function transform(BillPay $model)
    {
        return [
            'id'          => (int) $model->id,

            'date_due'    => $model->date_due,
            'name'        => $model->name,
            'value'       => (float) $model->value,
            'done'        => (boolean) $model->done,
            'category_id' => (int) $model->category_id,
            'bank_account_id' => (int) $model->bank_account_id,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeCategory(BillPay $model)
    {
        $transformer = new CategoryTransformer();
        $transformer->setDefaultIncludes([]);

        return $this->item($model->category, $transformer);
    }

    public function includeBankAccount(BillPay $model)
    {
        return $this->item($model->bankAccount, new BankAccountTransformer());
    }
}