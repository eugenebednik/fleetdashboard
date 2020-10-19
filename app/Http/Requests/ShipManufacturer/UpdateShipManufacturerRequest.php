<?php

namespace App\Http\Requests\ShipManufacturer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateShipManufacturerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ship-manufacturer-update');
    }

    public function rules()
    {
        return [
            'tag' => 'required|unique:ship_manufacturers,tag',
            'name' => 'required|string',
            'description' => 'required|string'
        ];
    }
}
