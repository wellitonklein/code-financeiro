<?php

namespace CodeFin\Repositories;

use Carbon\Carbon;
use CodeFin\Events\BillStoredEvent;
use CodeFin\Serializer\BillSerializer;

trait BillRepositoryTrait
{
    public function create(array $attributes)
    {
        $skipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = parent::create($attributes);
        event(new BillStoredEvent($model));
        $this->repeatBill($attributes);

        $this->skipPresenter = $skipPresenter;
        return $this->parserResult($model);
    }

    public function update(array $attributes, $id)
    {
        $skipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $modelOld = $this->find($id);
        $model = parent::update($attributes, $id);

        event(new BillStoredEvent($model, $modelOld));

        $this->skipPresenter = $skipPresenter;
        return $this->parserResult($model);
    }

    protected function repeatBill(array $attributes)
    {
        if (isset($attributes['repeat'])){
            $repeat = filter_var($attributes['repeat'], FILTER_VALIDATE_BOOLEAN);
            $repeatNumber = filter_var($attributes['repeat_number'], FILTER_VALIDATE_INT);
            $repeatType = filter_var($attributes['repeat_type'], FILTER_VALIDATE_INT);
            $dateDue = $attributes['date_due'];

            if ($repeat){
                foreach (range(1,$repeatNumber) as $value){
                    $dateNew = $this->model->addDate($dateDue,$value,$repeatType);
                    $attributesNew = array_merge($attributes, ['date_due' => $dateNew->format('Y-m-d')]);
                    $model = parent::create($attributesNew);

                    event(new BillStoredEvent($model));
                }
            }
        }
    }

    public function paginate($limit = null, $columns = ['*'], $method = "paginate")
    {
        $skipPresenter = $this->skipPresenter;
        $this->skipPresenter();
        $collection = parent::paginate($limit, $columns, $method);
        $this->skipPresenter($skipPresenter);

        return $this->parserResult(new BillSerializer($collection, $this->formatBillsData()));
    }

    protected function getTotalByDone($done)
    {
        $result = $this->getQueryTotalByDone($done)->get();

        return (float)$result->first()->total;
    }

    protected function getQueryTotalByDone($done)
    {
        $this->resetModel();
        $this->applyCriteria();
        $query = $this->model
            ->selectRaw('SUM(value) as total')
            ->where('done', '=', $done);

        return $query;
    }

    protected function getTotalExpired()
    {
        $result = $this->getQueryTotalByDone(0)
            ->where('date_due', '<', (new Carbon())->format('Y-m-d'))
            ->get();

        return (float)$result->first()->total;
    }

    protected function formatBillsData()
    {
        $totalPaid = $this->getTotalByDone(1);
        $totalToPay = $this->getTotalByDone(0);
        $totalExpired = $this->getTotalExpired();

        return [
            'total_paid' => $totalPaid,
            'total_to_pay' => $totalToPay,
            'total_expired' => $totalExpired
        ];
    }
}