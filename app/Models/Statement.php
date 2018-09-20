<?php

namespace CodeFin\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Statement.
 *
 * @package namespace CodeFin\Models;
 */
class Statement extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'value',
        'balance',
        'bank_account_id',
    ];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

}
