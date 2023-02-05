<?php

namespace AtelliTech\Yii2;

use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;
use Yii;

/**
 * This is an adapter of Local.
 * All options are refering to this document https://flysystem.thephpleague.com/docs/adapter/local/
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class FlysystemAdapterLocal extends AbstractFlysystemAdapter
{
    /**
     * @var string $rootPath allows alias name which defined by default Yii2 or customize in config
     */
    public $rootPath;

    /**
     * @var array<string, array<string, int>> $visibility
     */
    public $visibility = [
                'file' => [
                    'public' => 0640,
                    'private' => 0604,
                ],
                'dir' => [
                    'public' => 0740,
                    'private' => 7604,
                ],
            ];

    /**
     * @var int $writeFlag default: LOCK_EX
     * @see https://www.php.net/manual/en/function.flock.php
     */
    public $writeFlag = LOCK_EX;

    /**
     * @var int $linkMode default: LocalFilesystemAdapter::DISALLOW_LINKS
     * @see https://github.com/thephpleague/flysystem/blob/3.x/src/Local/LocalFilesystemAdapter.php#L54
     */
    public $linkMode = LocalFilesystemAdapter::DISALLOW_LINKS;

    /**
     * create file system
     *
     * @return Filesystem
     */
    protected function create(): Filesystem
    {
        return new Filesystem(new LocalFilesystemAdapter(
            // Determine the root directory
            Yii::getAlias($this->rootPath),

            // Customize how visibility is converted to unix permissions
            PortableVisibilityConverter::fromArray($this->visibility),

            // Write flags
            $this->writeFlag,

            // How to deal with links, either DISALLOW_LINKS or SKIP_LINKS
            // Disallowing them causes exceptions when encountered
            $this->linkMode
        ));
    }
}