<?php
namespace Houngan\ConfigMerger\Exception;

class InvalidSourceFormatException extends \Exception
{
    public function __construct($filename)
    {
        parent::__construct(
            sprintf('Source: %s, does not contain mergeable content', $filename)
        );
    }
}
