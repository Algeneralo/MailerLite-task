<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use App\Http\Resources\SubscriberResource;
use App\Http\Requests\StoreSubscriberRequest;

class SubscribersController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::paginate();

        return SubscriberResource::collection($subscribers);
    }

    public function store(StoreSubscriberRequest $request)
    {
        $subscriber = Subscriber::create($request->validated());

        return new SubscriberResource($subscriber);
    }

    public function show(Subscriber $subscriber)
    {
        return new SubscriberResource($subscriber);
    }
}