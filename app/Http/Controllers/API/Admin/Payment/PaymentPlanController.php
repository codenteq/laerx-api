<?php

namespace App\Http\Controllers\API\Admin\Payment;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Payment\StorePaymentPlanRequest;
use App\Http\Requests\Admin\Payment\UpdatePaymentPlanRequest;
use App\Http\Resources\Admin\Payment\PaymentPlanResource;
use App\Services\Admin\Payment\PaymentPlanService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PaymentPlanController extends ApiController
{
    public function __construct(PaymentPlanService $service)
    {
        $this->paymentPlanService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-plan.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(PaymentPlanResource::collection($this->paymentPlanService->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePaymentPlanRequest  $request
     * @return JsonResponse
     */
    public function store(StorePaymentPlanRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-plan.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->paymentPlanService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $payment_plan
     * @return JsonResponse
     */
    public function show(int $payment_plan): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-plan.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new PaymentPlanResource($this->paymentPlanService->show($payment_plan)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePaymentPlanRequest  $payment_plan
     * @param  int  $payment_plan
     * @return JsonResponse
     */
    public function update(UpdatePaymentPlanRequest $request, $payment_plan): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-plan.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->paymentPlanService->update($request, $payment_plan);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $payment_plan
     * @return JsonResponse
     */
    public function destroy($payment_plan): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-plan.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->paymentPlanService->destroy($payment_plan);

        return $this->successResponse([], __('response.deleted'));
    }
}
