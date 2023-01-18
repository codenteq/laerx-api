<?php

namespace App\Http\Controllers\API\Admin\Language;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Language\StoreLanguageRequest;
use App\Http\Requests\Admin\Language\UpdateLanguageRequest;
use App\Http\Resources\Admin\Language\LanguageResource;
use App\Services\Admin\Language\LanguageService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class LanguageController extends ApiController
{
    public function __construct(LanguageService $service)
    {
        $this->languageService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.language.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(LanguageResource::collection($this->languageService->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLanguageRequest  $request
     * @return JsonResponse
     */
    public function store(StoreLanguageRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.language.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->languageService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $language
     * @return JsonResponse
     */
    public function show(int $language): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.language.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new LanguageResource($this->languageService->show($language)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateLanguageRequest  $request
     * @param  int  $language
     * @return JsonResponse
     */
    public function update(UpdateLanguageRequest $request, $language): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.language.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->languageService->update($request, $language);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $language
     * @return JsonResponse
     */
    public function destroy($language): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.language.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->languageService->destroy($language);

        return $this->successResponse([], __('response.deleted'));
    }
}
