<?php

namespace App\Http\Requests\ShipManufacturer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class DestroyShipManufacturerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ship-manufacturer-destroy');
    }

    public function rules()
    {
        return [];
    }
}
