<?php

namespace AtelliTech\Yii2;

use League\Flysystem\Filesystem;
use League\Flysystem\InMemory\InMemoryFilesystemAdapter;
use Yii;

/**
 * This is an adapter of InMemory.
 * All options are refering to this document https://flysystem.thephpleague.com/docs/adapter/in-memory/
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class FlysystemAdapterInMemory extends AbstractFlysystemAdapter
{
    /**
     * create file system
     *
     * @return Filesystem
     */
    protected function create(): Filesystem
    {
        return new Filesystem(new InMemoryFilesystemAdapter);
    }
}