<?php

namespace CodeFin\Iugu;

use CodeFin\Models\Client;
use CodeFin\Models\Plan;
use CodeFin\Models\User;

class IuguSubscriptionManager
{
    private $iuguCustomerClient;
    private $iuguPaymentMethodClient;

    public function __construct(IuguCustomerClient $iuguCustomerClient, IuguPaymentMethodClient $iuguPaymentMethodClient)
    {
        $this->iuguCustomerClient = $iuguCustomerClient;
        $this->iuguPaymentMethodClient = $iuguPaymentMethodClient;
    }

    public function create(User $user, Plan $plan, $data)
    {
        $cliente = $user->client;
        $customer = $this->makeCustomer($cliente);
        $customerId = $customer == null ? $cliente->code : $customer['id'];
        $this->makePaymentMethod($customerId,$data['payment_type'],$data['token_payment']);

        //criar assinatura na Iugu
    }

    protected function makeCustomer(Client $client)
    {
        if ($client->code == null){
            return $this->iuguCustomerClient->create($client->toArray());
        }
        return null;
    }

    protected function makePaymentMethod($customerId, $paymentType, $token){
        if ($paymentType == 'credit_card'){
            return $this->iuguPaymentMethodClient->create([
                'customer_id' => $customerId,
                'token' => $token
            ]);
        }
    }
}