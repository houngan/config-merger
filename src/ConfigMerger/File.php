<?php

namespace ConfigMerger;

use ConfigMerger\MergeProviderInterface;
use Zend\Stdlib\ArrayUtils;

class File implements MergeProviderInterface
{
    /** @var string  */
    protected $path = null;

    /**
     * Merge configs from multiple config files
     *
     * @param array $sources
     * @return array
     */
    public function merge(array $sources)
    {
        $config = [];

        foreach ($sources as $filename) {
            $config = ArrayUtils::merge(
                $config,
                $this->getConfig($filename)
            );
        }

        return $config;
    }

    /**
     * Sets base path for configs
     *
     * @param string $path
     * @throws Exception\PathNotFoundException
     */
    public function setPath($path)
    {
        if (!is_dir($path)) {
            throw new Exception\PathNotFoundException($path);
        }

        $this->path = $path;
    }

    /**
     * Returns config base path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Returns config from one file
     *
     * @param string $source Full path to file
     * @return array
     * @throws Exception\FileNotFoundException
     */
    protected function getConfig($source)
    {
        $filepath = $this->getPath() . '/' . $source;
        if (!is_readable($filepath)) {
            throw new Exception\FileNotFoundException($filepath);
        }

        return require_once $filepath;
    }
}
