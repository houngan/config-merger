<?php

namespace ConfigMerger;


interface MergeProviderInterface
{
    function merge(array $sources);
}
