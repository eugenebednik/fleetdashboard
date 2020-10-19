<?php

namespace App\Http\Requests\Ship;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class CreateShipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ship-create');
    }

    public function rules()
    {
        return [
            'manufacturer_id' => 'required|integer|exists:ship_manufacturers,id',
            'name' => 'required|string',
            'description' => 'required|string'
        ];
    }
}
