<?php

namespace AtelliTech\Yii2;

use Exception;
use League\Flysystem\Filesystem;
use yii\base\Component;
use yii\base\UnknownMethodException;

/**
 * This is an abstract class of adapter component for flysystem.
 *
 * @author Eric Huang <eric.huang@atelli.ai>
 */
abstract class AbstractFlysystemAdapter extends Component
{
    /**
     * @var Filesystem $fs
     */
    protected $fs;

    /**
     * implement __call
     *
     * @param string $name
     * @param array<mixed> $args
     * @return mixed
     */
    public function __call($name, $args)
    {
        try {
            return parent::__call($name, $args);
        } catch (UnknownMethodException $e) {
            if (!($this->fs instanceof Filesystem))
                $this->fs = $this->create();

            if (method_exists($this->fs, $name))
                return call_user_func_array([$this->fs, $name], $args);

            throw $e;
        }
    }

    /**
     * create file system
     *
     * @return Filesystem
     */
    abstract protected function create(): Filesystem;
}
