<?php

namespace App\Domain;

class ResourceTypes
{

    const LINK_TYPE = 'Link type';
    const PDF_FILE_TYPE = 'PDF download type';
    const HTML_SNIPPET_TYPE = 'HTML snippet type';

    public static function available() : array
    {
        return [
            self::LINK_TYPE => self::LINK_TYPE,
            self::PDF_FILE_TYPE => self::PDF_FILE_TYPE,
            self::HTML_SNIPPET_TYPE => self::HTML_SNIPPET_TYPE,
        ];
    }
}