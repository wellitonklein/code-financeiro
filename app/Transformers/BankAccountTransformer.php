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
//    protected $defaultIncludes = ['bank'];
    protected $availableIncludes = ['bank'];
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

            'name'       => $model->name,
            'agency'     => $model->agency,
            'account'    => $model->account,
            'balance'    => (float) $model->balance,
            'default'    => (bool) $model->default,
            'bank_id'    => (int) $model->bank_id,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }

    public function includeBank(BankAccount $model){
        $bank = $model->bank;
        return $this->item($bank, new BankTransformer());
    }
}
