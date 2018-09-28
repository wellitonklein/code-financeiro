<?php

namespace CodeFin\Iugu;

use Carbon\Carbon;
use CodeFin\Iugu\Exceptions\IuguPaymentMethodException;

/**
 * Created by PhpStorm.
 * User: tom
 * Date: 28/09/18
 * Time: 17:20
 */
class IuguPaymentMethodClient
{
    public function create(array $attributes)
    {
        $attributes['set_as_default'] = true;
        $attributes['description'] = 'Inserido em '.(new Carbon())->format('d/m/Y');
        $result = \Iugu_PaymentMethod::create($attributes);

        if (isset($result['errors'])){
            throw new IuguPaymentMethodException($result['errors']);
        }

        return $result;
    }
}