<?php

namespace App\Http\Controllers\API;

use App\Models\Subscriber;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubscriberResource;
use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;

class SubscribersController extends Controller
{
    public function index()
    {
        $subscribers = Subscriber::paginate(10);

        return SubscriberResource::collection($subscribers);
    }

    public function store(StoreSubscriberRequest $request)
    {
        $subscriber = Subscriber::create($request->validated());
        $subscriber->syncFields($request->fields);

        return new SubscriberResource($subscriber);
    }

    public function show(Subscriber $subscriber)
    {
        return new SubscriberResource($subscriber);
    }

    public function update(UpdateSubscriberRequest $request, Subscriber $subscriber)
    {
        $subscriber->update([
            'name'  => $request->name,
            'email' => $request->email,
            'state' => $request->state
        ]);

        $subscriber->syncFields($request->fields);

        return response()->json(['message' => 'Success', 'data' => $request->fields]);
    }
}