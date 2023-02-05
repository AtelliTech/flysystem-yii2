# flysystem-yii2
It's an adapter of file system for Yii2 that integrating with league/flysystem. But now only supports local, in memory and SFTP and will support AWS S3 or others adpater are developing ongoing.

## Supports
- Local
Please see [https://flysystem.thephpleague.com/docs/adapter/local/](https://flysystem.thephpleague.com/docs/adapter/local/)
- InMemory
Please see [https://flysystem.thephpleague.com/docs/adapter/in-memory/](https://flysystem.thephpleague.com/docs/adapter/in-memory/)
- SFTPv3
Please see [https://flysystem.thephpleague.com/docs/adapter/sftp-v3/](https://flysystem.thephpleague.com/docs/adapter/sftp-v3/)

## Getting Start
### Requirements
- php8.0+

### Install
```
$ /lib/path/composer require atellitech/flysystem-yii2
```

### Usage
#### Local
##### Add component into config file of yii2 project

```php=
...
"components": [
    "fs" => [
        'class' => 'AtelliTech\\Yii2\\FlysystemAdapterLocal',
        'rootPath' => '@runtime', // support alias name of Yii2 or defined in configuration,
        'visibility' => [ // see https://flysystem.thephpleague.com/docs/visibility/
                'file' => [
                    'public' => 0640,
                    'private' => 0604,
                ],
                'dir' => [
                    'public' => 0740,
                    'private' => 7604,
                ],
            ],
        'writeFlag' => LOCK_EX, // see https://www.php.net/manual/en/function.flock.php
        'linkMode' => 2 // see https://github.com/thephpleague/flysystem/blob/3.x/src/Local/LocalFilesystemAdapter.php#L54
    ]
]
```

#### InMemory
##### Add component into config file of yii2 project

```php=
...
"components": [
    "fs" => [
        'class' => 'AtelliTech\\Yii2\\FlysystemAdapterInMemory'
    ]
]
```

#### SFTPv3
##### Add component into config file of yii2 project

```php=
...
"components": [
    "fs" => [
        'class' => 'AtelliTech\\Yii2\\FlysystemAdapterSftpV3',
        'rootPath' => '/home/xxx',
        'host' => 'xxx', // host (required)
        'username' => 'xxx', // username (required)
        'password' => null, // password (optional, default: null) set to null if privateKey is used
        'privateKey' => null, // private key (optional, default: null) can be used instead of password, set to null if password is set
        'passphrase' => null, // passphrase (optional, default: null), set to null if privateKey is not used or has no passphrase
        'port' => 22, // port (optional, default: 22)
        'useAgent' => false, // use agent (optional, default: false)
        'timeout' => 30, // timeout (optional, default: 30)
        'maxTries' => 4, // max tries (optional, default: 4)
        'hostFingerprint' => null, // host fingerprint (optional, default: null),
        'connectivity' => null, // connectivity checker (must be an implementation of 'League\Flysystem\PhpseclibV2\ConnectivityChecker' to check if a connection can be established (optional, omit if you don't need some special handling for setting reliable connections)
        'visibility' [ // see https://flysystem.thephpleague.com/docs/visibility/
                'file' => [
                    'public' => 0640,
                    'private' => 0604,
                ],
                'dir' => [
                    'public' => 0740,
                    'private' => 7604,
                ],
            ],
    ]
]
```
