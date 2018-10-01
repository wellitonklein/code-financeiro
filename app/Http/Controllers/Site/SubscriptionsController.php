<?php

namespace CodeFin\Http\Controllers\Site;

use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Requests\SubscriptionCreateRequest;
use CodeFin\Repositories\Interfaces\PlanRepository;

class SubscriptionsController extends Controller
{
    private $planRepository;

    public function __construct(PlanRepository $planRepository)
    {
        $this->planRepository = $planRepository;
    }

    public function create()
    {
        $plan = $this->planRepository->all()->first();
        return view('site.subscriptions.create', compact('plan'));
    }

    public function store(SubscriptionCreateRequest $request)
    {
        dd($request);
    }
}