<?php

namespace App\Domain;

use App\Exceptions\ResourceIsNoSupportedException;
use App\Models\Resource\CodeSnippet;
use App\Models\Resource\File;
use App\Models\Resource\Link;
use Illuminate\Support\Facades\Validator;

class ResourceService
{

    public function all()
    {
        $links = Link::orderBy('created_at', 'desc')->get();
        $pdfFiles = File::pdf()->orderBy('created_at', 'desc')->get();
        $codeSnippets = CodeSnippet::html()->orderBy('created_at', 'desc')->get();

        return [
            ResourceTypes::LINK_TYPE => $links,
            ResourceTypes::PDF_FILE_TYPE => $pdfFiles,
            ResourceTypes::HTML_SNIPPET_TYPE => $codeSnippets,
        ];
    }

    public function create($data)
    {
        $data = $this->validateResourceType($data);

        $resource = ResourcesFactory::make($data['resource_type']);

        $validatedData = $this->validate($resource->rules(), $data);

        return $resource->store($validatedData);
    }

    public function update(string $resourceType, string $id,  array $data)
    {

        $resource = ResourcesFactory::make($resourceType);

        $validatedData = $this->validate($resource->rules(), $data);

        return $resource->update($id, $validatedData);
    }

    public function get(string $resourceType, string $id)
    {
        $resource = ResourcesFactory::make($resourceType);

        return $resource->get($id);
    }


    public function delete(string $id, array $data)
    {
        $data = $this->validateResourceType($data);

        $resource = ResourcesFactory::make($data['resource_type']);

        $resource->delete($id);
    }

    public function getAvailableTypes()
    {
        return ResourceTypes::available();
    }

    private function validate(array $rules, array $data)
    {
        return Validator::make($data, $rules)->validate();
    }

    private function validateResourceType(array $data): array
    {
        if (isset($data['resource_type']) == false) {
            throw new ResourceIsNoSupportedException('resource_type must be provided');
        }
        return $data;
    }
}