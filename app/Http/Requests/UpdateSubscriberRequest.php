<?php

namespace App\Http\Requests;

use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubscriberRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'email:rfc,dns', Rule::unique('subscribers', 'email')->ignore($this->subscriber->id)],
            'state'          => ['required', Rule::in(Subscriber::$default_states)],
            'fields.*.title' => ['required', 'string', 'max:255'],
            'fields.*.type'  => ['required', Rule::in(Field::$default_types)],
        ];
    }
}