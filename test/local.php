<?php

namespace App;

use Yii;

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/vendor/yiisoft/yii2/Yii.php';

$config = [
    'class' => 'AtelliTech\Yii2\FlysystemAdapterLocal',
    'rootPath' => __DIR__,
];

$fs = Yii::createObject($config);
$listing = $fs->listContents('');
foreach($listing as $item) {
    echo "\nPath: " . $item->path();
}
