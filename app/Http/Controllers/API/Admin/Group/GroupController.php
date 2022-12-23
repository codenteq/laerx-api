<?php

namespace App\Http\Controllers\API\Admin\Group;

use App\Http\Controllers\API\ApiController;
use App\Http\Requests\Admin\Group\StoreGroupRequest;
use App\Http\Requests\Admin\Group\UpdateGroupRequest;
use App\Http\Resources\Admin\Group\GroupResource;
use App\Services\Admin\Group\GroupService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends ApiController
{
    public function __construct(GroupService $service)
    {
        $this->groupService = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.group.list'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(GroupResource::collection($this->groupService->list()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreGroupRequest  $request
     * @return JsonResponse
     */
    public function store(StoreGroupRequest $request): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.group.create'),
            Response::HTTP_FORBIDDEN
        );

        $this->groupService->create($request);

        return $this->successResponse([], __('response.created'), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $group
     * @return JsonResponse
     */
    public function show(int $group): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.group.show'),
            Response::HTTP_FORBIDDEN
        );

        return $this->successResponse(new GroupResource($this->groupService->show($group)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateGroupRequest  $request
     * @param  int  $group
     * @return JsonResponse
     */
    public function update(UpdateGroupRequest $request, $group): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.group.update'),
            Response::HTTP_FORBIDDEN
        );

        $this->groupService->update($request, $group);

        return $this->successResponse([], __('response.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $group
     * @return JsonResponse
     */
    public function destroy($group): JsonResponse
    {
        abort_unless(auth()->user()->tokenCan('admin.group.delete'),
            Response::HTTP_FORBIDDEN
        );

        $this->groupService->destroy($group);

        return $this->successResponse([], __('response.deleted'));
    }
}
