<?php

namespace CodeFin\Iugu;
use CodeFin\Repositories\Interfaces\ClientRepository;

/**
 * Created by PhpStorm.
 * User: tom
 * Date: 28/09/18
 * Time: 17:20
 */
class IuguCustomerClient
{
    private $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function create(array $attributes)
    {
        $result = \Iugu_Customer::create(array_only($attributes, ['name','email']));

        if (isset($result['errors'])){
            throw new IuguCustomerException($result['errors']);
        }
        $this->clientRepository->update(['code' => $result['id']], $attributes['id']);

        return $result;
    }
}