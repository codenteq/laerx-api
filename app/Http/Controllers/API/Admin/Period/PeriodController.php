<?php

namespace App\Http\Controllers\API\Admin\Period;

use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Period\StorePeriodRequest;
use App\Http\Requests\Admin\Period\UpdatePeriodRequest;
use App\Http\Resources\Admin\Period\PeriodResource;
use App\Services\Admin\Period\PeriodService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PeriodController extends ApiController
{
    public function __construct(PeriodService $service)
    {
        $this->periodService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.period.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(PeriodResource::collection($this->periodService->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePeriodRequest  $request
     * @return JsonResponse
     */
    public function store(StorePeriodRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.period.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->periodService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $period
     * @return JsonResponse
     */
    public function show(int $period): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.period.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new PeriodResource($this->periodService->show($period)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePeriodRequest  $request
     * @param  int  $period
     * @return JsonResponse
     */
    public function update(UpdatePeriodRequest $request, $period): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.period.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->periodService->update($request, $period);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $period
     * @return JsonResponse
     */
    public function destroy($period): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.period.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->periodService->destroy($period);

        return $this->successResponse([], __('response.deleted'));
    }
}
