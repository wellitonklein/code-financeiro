<?php

namespace CodeFin\Repositories;

trait BillRepositoryTrait
{
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
                    parent::create($attributesNew);
                }
            }
        }
    }
}