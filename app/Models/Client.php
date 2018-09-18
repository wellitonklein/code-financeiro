<?php

namespace CodeFin\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Client.
 *
 * @package namespace CodeFin\Models;
 */
class Client extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function bankAccounts(){
        return $this->hasMany(BankAccount::class);
    }

    public function categoryExpenses(){
        return $this->hasMany(CategoryExpense::class);
    }
}
