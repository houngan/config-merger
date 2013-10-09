<?php

namespace Houngan\ConfigMerger;

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

        $this->path = rtrim($path, DIRECTORY_SEPARATOR);
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
     * @throws Exception\InvalidSourceFormatException
     * @throws Exception\FileNotFoundException
     * @return array
     */
    protected function getConfig($source)
    {
        $filepath = $this->getPath() . DIRECTORY_SEPARATOR . $source;
        if (!is_readable($filepath)) {
            throw new Exception\FileNotFoundException($filepath);
        }

        $config = require $filepath;
        if (!is_array($config)) {
            throw new Exception\InvalidSourceFormatException($filepath);
        }

        return $config;
    }
}
