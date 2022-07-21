<?php

namespace App\Http\Controllers\Api;

use App\Domain\ResourceService;
use App\Models\Resource\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ResourceController
{
    private ResourceService $resourceService;

    public function __construct(ResourceService $resourceService)
    {
        $this->resourceService = $resourceService;
    }

    public function index()
    {
        return $this->resourceService->all();
    }

    public function show(string $resourceType, string $id)
    {
        return $this->resourceService->get($resourceType, $id);
    }

    public function store(Request $request)
    {
        return $this->resourceService->create($request->all());
    }

    public function update(Request $request, string $resourceType, string $id)
    {
        return $this->resourceService->update($resourceType, $id, $request->all());
    }

    public function types()
    {
        return $this->resourceService->getAvailableTypes();
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        $exists = Storage::exists($file->path);
        if($exists) {
            return Storage::disk('local')->download( $file->path);
        }

        return response()->noContent();
    }

    public function delete(Request $request, string $id)
    {
        $this->resourceService->delete($id, $request->all());
        return response()->noContent();
    }


}