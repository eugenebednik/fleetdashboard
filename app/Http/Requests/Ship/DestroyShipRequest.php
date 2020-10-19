<?php

namespace App\Http\Requests\Ship;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class DestroyShipRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('ship-destroy');
    }

    public function rules()
    {
        return [];
    }
}
