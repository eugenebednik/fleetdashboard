<?php

namespace App\Http\Controllers\Api\ShipManufacturers;

use App\Http\Requests\ShipManufacturer\CreateShipManufacturerRequest;
use App\Http\Requests\ShipManufacturer\UpdateShipManufacturerRequest;
use App\Http\Resources\ShipManufacturers\ShipManufacturersResource;
use App\Models\ShipManufacturer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ShipManufacturersController extends Controller
{
    public function index() : JsonResponse
    {
        return ShipManufacturersResource::make(ShipManufacturer::all())
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function show(int $id) : JsonResponse
    {
        return ShipManufacturersResource::make(ShipManufacturer::findOrFail($id))
            ->response()
            ->setStatusCode(Response::HTTP_OK);
    }

    public function create(CreateShipManufacturerRequest $request) : JsonResponse
    {
        $manufacturer = new ShipManufacturer();
        $manufacturer->tag = $request->input('tag');
        $manufacturer->name = $request->input('name');
        $manufacturer->description = $request->input('description');
        $manufacturer->save();

        return ShipManufacturersResource::make($manufacturer)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateShipManufacturerRequest $request, int $id) : JsonResponse
    {
        $manufacturer = ShipManufacturer::findOrFail($id);
        $manufacturer->tag = $request->input('tag');
        $manufacturer->name = $request->input('name');
        $manufacturer->description = $request->input('description');
        $manufacturer->save();

        return ShipManufacturersResource::make($manufacturer)
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(int $id) : Response
    {
        ShipManufacturer::findOrFail($id)->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
