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
            'id'         => (int) $model->id,

            'date_due'   => $model->date_due,
            'name'       => $model->name,
            'value'      => (float) $model->value,
            'done'       => (boolean) $model->done,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}