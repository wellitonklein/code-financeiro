<?php

namespace CodeFin\Http\Controllers\Api;

use \Carbon\Carbon;
/**
 * Created by PhpStorm.
 * User: tom
 * Date: 28/09/18
 * Time: 00:08
 */
trait BillControllerTrait
{
    public function findToPayToToday()
    {
        $dateStart = new Carbon();
        $dateEnd = $dateStart->copy();

        return $this->repository->getTotalFromPeriod($dateStart, $dateEnd);
    }

    public function findToPayRestOfMonth()
    {
        $dateStart = (new Carbon())->addDays(1);

        if ($dateStart->month != (new Carbon())->month){
            $dateStart->subDays(1);
        }

        $dateEnd = $dateStart->copy()->day($dateStart->daysInMonth);

        return $this->repository->getTotalFromPeriod($dateStart, $dateEnd);
    }
}