<?php

namespace AtelliTech\Yii2;

use League\Flysystem\Filesystem;
use League\Flysystem\PhpseclibV3\ConnectivityChecker;
use League\Flysystem\PhpseclibV3\SftpAdapter;
use League\Flysystem\PhpseclibV3\SftpConnectionProvider;
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;

/**
 * This is an adapter of SFTP, please install league/flysystem-sftp-v3 when using this adapter.
 * All options are refering to this document https://flysystem.thephpleague.com/docs/adapter/sftp-v3/
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
class FlysystemAdapterSftpV3 extends AbstractFlysystemAdapter
{
    /**
     * @var string $host
     */
    public $host;

    /**
     * @var string $username
     */
    public $username;

    /**
     * @var string $password default: null
     */
    public $password = null;

    /**
     * @var string $privateKey default: null
     */
    public $privateKey = null;

    /**
     * @var string $passphrase default: null
     */
    public $passphrase = null;

    /**
     * @var int $port default: 22
     */
    public $port = 22;

    /**
     * @var bool $useAgent default: false
     */
    public $useAgent = false;

    /**
     * @var int $timeout default: 30
     */
    public $timeout = 30;

    /**
     * @var int $maxTries default: 10
     */
    public $maxTries = 10;

    /**
     * @var string $hostFingerprint default: null
     */
    public $hostFingerprint = null;

    /**
     * @var null|ConnectivityChecker $connectivity default: null
     */
    public $connectivity = null;

    /**
     * @var string $rootPath
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
     * create file system
     *
     * @return Filesystem
     */
    protected function create(): Filesystem
    {
        return new Filesystem(new SftpAdapter(
            new SftpConnectionProvider(
                $this->host, // host (required)
                $this->username, // username (required)
                $this->password, // password (optional, default: null) set to null if privateKey is used
                $this->privateKey, // private key (optional, default: null) can be used instead of password, set to null if password is set
                $this->passphrase, // passphrase (optional, default: null), set to null if privateKey is not used or has no passphrase
                $this->port, // port (optional, default: 22)
                $this->useAgent, // use agent (optional, default: false)
                $this->timeout, // timeout (optional, default: 10)
                $this->maxTries, // max tries (optional, default: 4)
                $this->hostFingerprint, // host fingerprint (optional, default: null),
                $this->connectivity ? new $this->connectivity : null, // connectivity checker (must be an implementation of 'League\Flysystem\PhpseclibV2\ConnectivityChecker' to check if a connection can be established (optional, omit if you don't need some special handling for setting reliable connections)
            ),
            $this->rootPath, // root path (required)
            PortableVisibilityConverter::fromArray($this->visibility)
        ));
    }
}