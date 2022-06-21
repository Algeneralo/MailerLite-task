<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\Subscriber;

class SubscribersController extends Controller
{
    public function index()
    {
        return view('subscriber.index');
    }

    public function create()
    {
        return view('subscriber.create', [
            'states'      => Subscriber::$default_states,
            'field_types' => Field::$default_types,
        ]);
    }

    public function edit(Subscriber $subscriber)
    {
        return view('subscriber.edit', [
            'subscriber'  => $subscriber,
            'states'      => Subscriber::$default_states,
            'fields'      => $subscriber->fields()->select(['title', 'type'])->get()->toArray(),
            'field_types' => Field::$default_types,
        ]);
    }


}