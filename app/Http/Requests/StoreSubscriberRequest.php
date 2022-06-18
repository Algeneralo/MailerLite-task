<?php

namespace App\Http\Requests;

use App\Models\Subscriber;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSubscriberRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc,dns'],
            'state' => ['required', Rule::in(Subscriber::$default_states)]
        ];
    }
}