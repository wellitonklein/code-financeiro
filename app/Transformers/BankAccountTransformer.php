<?php

namespace CodeFin\Transformers;

use League\Fractal\TransformerAbstract;
use CodeFin\Models\BankAccount;

/**
 * Class BankAccountTransformer.
 *
 * @package namespace CodeFin\Transformers;
 */
class BankAccountTransformer extends TransformerAbstract
{
    /**
     * Transform the BankAccount entity.
     *
     * @param \CodeFin\Models\BankAccount $model
     *
     * @return array
     */
    public function transform(BankAccount $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'name' => $model->name,
            'agency' => $model->agency,
            'account' => $model->account,
            'default' => (bool) $model->default,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
