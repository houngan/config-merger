<?php
namespace ConfigMerger\Exception;

class FileNotFoundException extends \Exception
{
    public function __construct($filename)
    {
        parent::__construct(sprintf('File: %s, not found', $filename));
    }
}
