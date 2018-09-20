<?php

namespace CodeFin\Models;

use HipsterJazzbo\Landlord\BelongsToTenants;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BankAccount.
 *
 * @package namespace CodeFin\Models;
 */
class BankAccount extends Model implements Transformable
{
    use TransformableTrait;
    use BelongsToTenants;

    protected $fillable = [
        'name',
        'agency',
        'account',
        'bank_id',
        'default'
    ];

    protected $casts = [
        'balance' => 'float'
    ];

    public function bank(){
        return $this->belongsTo(Bank::class);
    }
}
