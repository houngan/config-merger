<?php

namespace Houngan\ConfigMerger;


interface MergeProviderInterface
{
    public function merge(array $sources);
}
