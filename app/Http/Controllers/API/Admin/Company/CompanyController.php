<?php

namespace App\Http\Controllers\API\Admin\Company;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Company\StoreCompanyRequest;
use App\Http\Requests\Admin\Company\UpdateCompanyRequest;
use App\Http\Resources\Admin\Company\CompanyResource;
use App\Services\Admin\Company\CompanyService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends ApiController
{
    public function __construct(CompanyService $service)
    {
        $this->companyService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.company.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(CompanyResource::collection($this->companyService->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreCompanyRequest  $request
     * @return JsonResponse
     */
    public function store(StoreCompanyRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.company.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->companyService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $company
     * @return JsonResponse
     */
    public function show(int $company): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.company.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new CompanyResource($this->companyService->show($company)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateCompanyRequest  $company
     * @param  int  $company
     * @return JsonResponse
     */
    public function update(UpdateCompanyRequest $request, $company): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.company.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->companyService->update($request, $company);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $company
     * @return JsonResponse
     */
    public function destroy($company): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.company.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->companyService->destroy($company);

        return $this->successResponse([], __('response.deleted'));
    }
}
