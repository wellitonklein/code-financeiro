<?php

namespace CodeFin\Repositories;

use Carbon\Carbon;
use CodeFin\Models\BillPay;
use CodeFin\Models\BillReceive;
use CodeFin\Models\CategoryExpense;
use CodeFin\Models\CategoryRevenue;
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

    public function getCashFlow(Carbon $dateStart, Carbon $dateEnd)
    {
        $datePrevious = $dateStart->copy()->day(1)->subMonths(2);
        $datePrevious->day($datePrevious->daysInMonth);

        $balancePreviousMonth = $this->getBalanceByMonth($datePrevious);

        $revenuesCollection = $this->getCategoriesValuesCollection(
            new CategoryRevenue(),
            (new BillReceive())->getTable(),
            $dateStart,
            $dateEnd
        );

        $expensesCollection = $this->getCategoriesValuesCollection(
            new CategoryExpense(),
            (new BillPay())->getTable(),
            $dateStart,
            $dateEnd
        );

        return $this->formatCashFlow($expensesCollection, $revenuesCollection, $balancePreviousMonth);
    }

    protected function formatCategories($collection){
        /**
         * id: 0
         * name: Category x
         * months: [
         *  {total: 10, month_year: '2018-10'},{total: 40, month_year: '2018-12'}
         * ]
         */
        $categories = $collection->unique('name')->pluck('name','id')->all();
        $arrayResult = [];

        foreach ($categories as $id => $name){
            $filtered = $collection->where('id',$id)->where('name',$name);
            $months_year = [];
            $filtered->each(function ($category) use (&$months_year){
                $months_year[] = [
                    'total' => $category->total,
                    'month_year' => $category->month_year,
                ];
            });
            $arrayResult[] = [
                'id'     => $id,
                'name'   => $name,
                'months' => $months_year
            ];
        }

        return $arrayResult;
    }

    protected function formatMonthsYear($expensesCollection,$revenuesCollecion)
    {
        /**
         * months_lists: {
        {month_year: '2018-09', receives: {total: 10}, expenses: {total: 5}}
         * }
         */
        $monthsYearExpenseCollection = $expensesCollection->pluck('month_year');
        $monthsYearRevenueCollection = $revenuesCollecion->pluck('month_year');

        $monthsYearsCollection = $monthsYearExpenseCollection->merge($monthsYearRevenueCollection)->unique()->sort();
        $monthsYearList = [];
        $monthsYearsCollection->each(function ($monthYear) use (&$monthsYearList){
            $monthsYearList[$monthYear] = [
                'month_year' => $monthYear,
                'revenues' => ['total' => 0],
                'expenses' => ['total' => 0],
            ];
        });

        foreach ($monthsYearRevenueCollection as $monthYear){
            $monthsYearList[$monthYear]['revenues']['total'] = $revenuesCollecion->where('month_year', $monthYear)->sum('total');
        }

        foreach ($monthsYearExpenseCollection as $monthYear){
            $monthsYearList[$monthYear]['expenses']['total'] = $expensesCollection->where('month_year', $monthYear)->sum('total');
        }

        return array_values($monthsYearList);
    }

    protected function formatCashFlow($expensesCollection, $revenuesCollection, $balancePreviousMonth)
    {
        $monthsYearList = $this->formatMonthsYear($expensesCollection,$revenuesCollection);
        $expensesFormatted = $this->formatCategories($expensesCollection);
        $revenuesFormatted = $this->formatCategories($revenuesCollection);

        $collectionFormatted  = [
            'months_list' => $monthsYearList,
            'balance_before_first_month' => $balancePreviousMonth,
            'categories_months' => [
                'expenses' => [
                    'data' => $expensesFormatted
                ],
                'revenues' => [
                    'data' => $revenuesFormatted
                ],
            ]
        ];

        return $collectionFormatted;
    }

    protected function getCategoriesValuesCollection($model, $billTable, Carbon $dateStart, Carbon $dateEnd)
    {
        $dateStartStr = $dateStart->copy()->day(1)->format('Y-m-d');
        $dateEndStr = $dateEnd->copy()->day($dateEnd->daysInMonth)->format('Y-m-d');

        $firstDateStart = $dateStart->copy()->subMonths(1);
        $firstDateStartStr = $firstDateStart->format('Y-m-d');

        $firstDateEnd = $firstDateStart->copy()->day($firstDateStart->daysInMonth);
        $firstDateEndStr = $firstDateEnd->format('Y-m-d');

        $firstCollection = $this->getQueryCategoriesValuesByPeriodAndDone(
            $model,
            $billTable,
            $firstDateStartStr,
            $firstDateEndStr
        )->get();

        $mainCollection = $this->getQueryCategoriesValuesByPeriod(
            $model,
            $billTable,
            $dateStartStr,
            $dateEndStr
        )->get();

        $firstCollection->reverse()->each(function ($value) use ($mainCollection){
            $mainCollection->prepend($value);
        });

        return $mainCollection;
    }

    protected function getQueryCategoriesValuesByPeriodAndDone($model, $billTable, $dateStart, $dateEnd)
    {
        return $this->getQueryCategoriesValuesByPeriod($model,$billTable,$dateStart,$dateEnd)
            ->where('done', 1);
    }

    protected function getQueryCategoriesValuesByPeriod($model, $billTable, $dateStart, $dateEnd)
    {
        $table = $model->getTable();
        list($lft, $rgt) = [$model->getLftName(), $model->getRgtName()];

        return $model
            ->addSelect("$table.id")
            ->addSelect("$table.name")
            ->selectRaw("SUM(value) as total")
            ->selectRaw("DATE_FORMAT(date_due, '%Y-%m') as month_year")
            ->selectSub($this->getQueryWithDepth($model), 'depth')
            ->join("$table as childOrSelf", function ($join) use ($table,$lft,$rgt){
                $join->on("$table.$lft", '<=', "childOrSelf.$lft")
                    ->whereRaw("$table.$rgt >= childOrSelf.$rgt");
            })
            ->join($billTable, "$billTable.category_id", '=', 'childOrSelf.id')
            ->whereBetween('date_due', [$dateStart, $dateEnd])
            ->groupBy("$table.id","$table.name", 'month_year')
            ->havingRaw("depth = 0")
            ->orderBy("month_year")
            ->orderBy("$table.name");
    }

    protected function getQueryWithDepth($model)
    {
        $table = $model->getTable();

        list($lft, $rgt) = [$model->getLftName(), $model->getRgtName()];

        $alias = '_d';

        return $model
            ->newScopedQuery($alias)
            ->toBase()
            ->selectRaw('count(1) - 1')
            ->from("{$table} as {$alias}")
            ->whereRaw("{$table}.{$lft} between {$alias}.{$lft} and {$alias}.{$rgt}");
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
