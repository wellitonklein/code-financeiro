<?php

namespace CodeFin\Repositories;

use Carbon\Carbon;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use CodeFin\Models\Statement;

/**
 * Class StatementRepositoryEloquent.
 *
 * @package namespace CodeFin\Repositories;
 */
class StatementRepositoryEloquent extends BaseRepository implements StatementRepository
{
    public function create(array $attributes)
    {
        $statementable = $attributes['statementable'];
        return $statementable->statements()->create(array_except($attributes, 'statementable'));
    }

    protected function getQueryCategoriesValuesByPeriod($model, $billTable, $dateStart, $dateEnd)
    {
        $table = $model->getTable();

        return $model
            ->addSelect("$table.id")
            ->addSelect("$table.name")
            ->selectRaw("SUM(value) as total")
            ->selectRaw("DATE_FORMAT(date_due, '%Y-%m') as month_year")
            ->whereBetween('date_due', [$dateStart, $dateEnd])
            ->groupBy("$table.id","$table.name", 'month_year')
            ->orderBy("month_year")
            ->orderBy("$table.name");
    }

    public function getBalanceByMonth(Carbon $date)
    {
        $dateString = $date->copy()->day($date->daysInMonth)->format('Y-m-d');
        $modelClass = $this->model();

        $subQuery = (new $modelClass)
            ->toBase()
            ->selectRaw("bank_account_id, MAX(statements.id) as maxid")
            ->whereRaw("statements.created_at <= '$dateString'")
            ->groupBy('bank_account_id');

        $result = (new $modelClass)
            ->selectRaw("SUM(statements.balance) as total")
            ->join(\DB::raw("({$subQuery->toSql()}) as s"), 'statements.id', '=', 's.maxid')
            ->mergeBindings($subQuery)
            ->get();

        //Query - somar os saldos unicos das contas
        //Query - selecionar os ultimos ids de extrato referente a data
        return $result->first()->total === null ? 0 : $result->first()->total;
    }

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Statement::class;
    }



    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}
