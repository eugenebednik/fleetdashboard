<?php

namespace App\Http\Controllers\Api\Ships;

use App\Http\Requests\Ship\CreateShipRequest;
use App\Http\Requests\Ship\UpdateShipRequest;
use App\Http\Resources\Ships\ShipsResource;
use App\Models\Ship;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ShipsController extends Controller
{
    public function index() : ShipsResource
    {
        return ShipsResource::make(Ship::all());
    }

    public function show(int $id) : JsonResponse
    {
        return ShipsResource::make(Ship::findOrFail($id))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function create(CreateShipRequest $request) : JsonResponse
    {
        $ship = new Ship();
        $ship->name = $request->input('name');
        $ship->manufacturer()->associate($request->input('manufacturer_id'));
        $ship->save();

        return ShipsResource::make($ship)->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateShipRequest $request, int $id) : JsonResponse
    {
        $ship = Ship::findOrFail($id);
        $ship->name = $request->input('name');
        $ship->manufacturer()->associate($request->input('manufacturer_id'));
        $ship->save();

        return ShipsResource::make($ship)->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(int $id) : Response
    {
        Ship::findOrFail($id)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
