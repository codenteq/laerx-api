<?php

namespace App\Http\Controllers\API\Admin\CarType;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\CarType\StoreCarTypeRequest;
use App\Http\Requests\Admin\CarType\UpdateCarTypeRequest;
use App\Http\Resources\Admin\CarType\CarTypeResource;
use App\Services\Admin\CarType\CarTypeService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CarTypeController extends ApiController
{
    public function __construct(CarTypeService $service)
    {
        $this->carTypeService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.car-type.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(CarTypeResource::collection($this->carTypeService->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCarTypeRequest  $request
     * @return JsonResponse
     */
    public function store(StoreCarTypeRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.car-type.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->carTypeService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $car_type
     * @return JsonResponse
     */
    public function show(int $car_type): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.car-type.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new CarTypeResource($this->carTypeService->show($car_type)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCarTypeRequest  $request
     * @param  int  $car_type
     * @return JsonResponse
     */
    public function update(UpdateCarTypeRequest $request, $car_type): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.car-type.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->carTypeService->update($request, $car_type);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $car_type
     * @return JsonResponse
     */
    public function destroy($car_type): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.car-type.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->carTypeService->destroy($car_type);

        return $this->successResponse([], __('response.deleted'));
    }
}
