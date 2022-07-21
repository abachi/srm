<?php

namespace App\Domain;

use App\Exceptions\ResourceIsNoSupportedException;

class ResourcesFactory
{

    public static function make(string $resourceType): ResourcesInterface
    {
        switch ($resourceType) {
            case ResourceTypes::LINK_TYPE:
                return new LinkResource();

            case ResourceTypes::HTML_SNIPPET_TYPE:
                return new HTMLSnippetResource();

            case ResourceTypes::PDF_FILE_TYPE:
                return new PDFFileResource();

            default:
                throw new ResourceIsNoSupportedException();

        }
    }
}