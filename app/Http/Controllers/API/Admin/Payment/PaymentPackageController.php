<?php

namespace App\Http\Controllers\API\Admin\Payment;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Payment\StorePaymentPackageRequest;
use App\Http\Requests\Admin\Payment\UpdatePaymentPackageRequest;
use App\Http\Resources\Admin\Payment\PaymentPackageResource;
use App\Services\Admin\Payment\PaymentPackageService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PaymentPackageController extends ApiController
{
    public function __construct(PaymentPackageService $service)
    {
        $this->paymentPackageService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-package.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(PaymentPackageResource::collection($this->paymentPackageService->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePaymentPackageRequest  $request
     * @return JsonResponse
     */
    public function store(StorePaymentPackageRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-package.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->paymentPackageService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $payment_package
     * @return JsonResponse
     */
    public function show(int $payment_package): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-package.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new PaymentPackageResource($this->paymentPackageService->show($payment_package)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePaymentPackageRequest  $payment_package
     * @param  int  $payment_package
     * @return JsonResponse
     */
    public function update(UpdatePaymentPackageRequest $request, $payment_package): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-package.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->paymentPackageService->update($request, $payment_package);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $payment_package
     * @return JsonResponse
     */
    public function destroy($payment_package): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.payment-package.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->paymentPackageService->destroy($payment_package);

        return $this->successResponse([], __('response.deleted'));
    }
}
