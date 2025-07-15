<?php

namespace Intervention\Image;

use Intervention\Image\Interfaces\ImageInterface;

class CachedImage
{
    /**
     * Original image instance
     *
     * @var ImageInterface
     */
    protected $image;

    /**
     * Cache key
     *
     * @var string
     */
    public $cachekey;

    /**
     * Create instance with driver and core from original image
     *
     * @param ImageInterface $original
     * @param string $cachekey
     * @return static
     */
    public function setFromOriginal(ImageInterface $original, $cachekey)
    {
        $this->image = $original;
        $this->cachekey = $cachekey;

        return $this;
    }

    /**
     * Get the wrapped image instance
     *
     * @return ImageInterface
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Forward all method calls to the original image
     *
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function __call($method, $arguments)
    {
        if ($this->image) {
            return call_user_func_array([$this->image, $method], $arguments);
        }

        throw new \BadMethodCallException("Method {$method} does not exist or image not set");
    }

    /**
     * Forward property access to the original image
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if ($name === 'cachekey') {
            return $this->cachekey;
        }

        if ($this->image && property_exists($this->image, $name)) {
            return $this->image->$name;
        }

        return null;
    }

    /**
     * Forward property setting to the original image
     *
     * @param string $name
     * @param mixed $value
     * @return void
     */
    public function __set($name, $value)
    {
        if ($name === 'cachekey') {
            $this->cachekey = $value;
            return;
        }

        if ($this->image && property_exists($this->image, $name)) {
            $this->image->$name = $value;
        }
    }

    /**
     * Convert to string (encode as string)
     *
     * @return string
     */
    public function __toString()
    {
        if ($this->image) {
            return (string) $this->image;
        }

        return '';
    }
}
