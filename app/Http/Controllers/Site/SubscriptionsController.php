<?php

namespace CodeFin\Http\Controllers\Site;

use CodeFin\Http\Controllers\Controller;
use CodeFin\Http\Requests\SubscriptionCreateRequest;
use CodeFin\Iugu\IuguSubscriptionManager;
use CodeFin\Repositories\Interfaces\PlanRepository;

class SubscriptionsController extends Controller
{
    private $planRepository;
    private $iuguSubscriptionManager;

    public function __construct(PlanRepository $planRepository, IuguSubscriptionManager $iuguSubscriptionManager)
    {
        $this->planRepository = $planRepository;
        $this->iuguSubscriptionManager = $iuguSubscriptionManager;
    }

    public function create()
    {
        $plan = $this->planRepository->all()->first();
        return view('site.subscriptions.create', compact('plan'));
    }

    public function store(SubscriptionCreateRequest $request)
    {
        $plan = $this->planRepository->all()->first();
        $this->iuguSubscriptionManager->create(
            \Auth::user(),
            $plan,
            $request->all()
        );
    }
}