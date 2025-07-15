<?php

namespace Intervention\Image\Interfaces;

use Intervention\Image\Laravel\Facades\ImageCache;

/**
 * ImageCache Contract
 * 
 * Defines the interface for image caching operations
 * to provide type safety for callback functions.
 * 
 * @method $this resize(int|null $width = null, int|null $height = null)
 * @method $this resizeDown(int|null $width = null, int|null $height = null)
 * @method $this scale(int|null $width = null, int|null $height = null)
 * @method $this scaleDown(int|null $width = null, int|null $height = null)
 * @method $this crop(int $width, int $height, int $offset_x = 0, int $offset_y = 0, mixed $background = 'ffffff', string $position = 'top-left')
 * @method $this cover(int $width, int $height, string $position = 'center')
 * @method $this coverDown(int $width, int $height, string $position = 'center')
 * @method $this contain(int $width, int $height, mixed $background = 'ffffff', string $position = 'center')
 * @method $this pad(int $width, int $height, mixed $background = 'ffffff', string $position = 'center')
 * @method $this resizeCanvas(int|null $width = null, int|null $height = null, mixed $background = 'ffffff', string $position = 'center')
 * @method $this resizeCanvasRelative(int|null $width = null, int|null $height = null, mixed $background = 'ffffff', string $position = 'center')
 * @method $this rotate(float $angle, mixed $background = 'ffffff')
 * @method $this flip()
 * @method $this flop()
 * @method $this trim(int $tolerance = 0)
 * @method $this greyscale()
 * @method $this invert()
 * @method $this brightness(int $level)
 * @method $this contrast(int $level)
 * @method $this gamma(float $gamma)
 * @method $this colorize(int $red = 0, int $green = 0, int $blue = 0)
 * @method $this blur(int $amount = 5)
 * @method $this sharpen(int $amount = 10)
 * @method $this pixelate(int $size)
 * @method $this orient()
 * @method $this fill(mixed $color, int|null $x = null, int|null $y = null)
 * @method $this place(mixed $element, string $position = 'top-left', int $offset_x = 0, int $offset_y = 0, int $opacity = 100)
 * @method $this text(string $text, int $x, int $y, callable|\Closure|\Intervention\Image\Interfaces\FontInterface $font)
 * @method $this drawPixel(int $x, int $y, mixed $color)
 * @method $this drawRectangle(int $x, int $y, callable|\Closure|\Intervention\Image\Geometry\Rectangle $init)
 * @method $this drawEllipse(int $x, int $y, callable|\Closure|\Intervention\Image\Geometry\Ellipse $init)
 * @method $this drawCircle(int $x, int $y, callable|\Closure|\Intervention\Image\Geometry\Circle $init)
 * @method $this drawPolygon(callable|\Closure|\Intervention\Image\Geometry\Polygon $init)
 * @method $this drawLine(callable|\Closure|\Intervention\Image\Geometry\Line $init)
 * @method $this drawBezier(callable|\Closure|\Intervention\Image\Geometry\Bezier $init)
 * @method $this save(string|null $path = null, mixed ...$options)
 * @method \Intervention\Image\Interfaces\EncodedImageInterface encode(\Intervention\Image\Interfaces\EncoderInterface $encoder = new \Intervention\Image\Encoders\AutoEncoder())
 * @method \Intervention\Image\Interfaces\EncodedImageInterface toJpeg(mixed ...$options)
 * @method \Intervention\Image\Interfaces\EncodedImageInterface toPng(mixed ...$options)
 * @method \Intervention\Image\Interfaces\EncodedImageInterface toGif(mixed ...$options)
 * @method \Intervention\Image\Interfaces\EncodedImageInterface toWebp(mixed ...$options)
 * @method \Intervention\Image\Interfaces\EncodedImageInterface toAvif(mixed ...$options)
 * @method \Intervention\Image\Interfaces\EncodedImageInterface toBitmap(mixed ...$options)
 * @method \Intervention\Image\Interfaces\EncodedImageInterface toTiff(mixed ...$options)
 * @method \Intervention\Image\Interfaces\EncodedImageInterface toHeic(mixed ...$options)
 * @method int width()
 * @method int height()
 * @method \Intervention\Image\Interfaces\SizeInterface size()
 * @method \Intervention\Image\Interfaces\ColorInterface pickColor(int $x, int $y, int $frame_key = 0)
 * @method mixed exif(string|null $query = null)
 * @method \Intervention\Image\Interfaces\ResolutionInterface resolution()
 * @method $this setResolution(float $x, float $y)
 * @method $this reduceColors(int $limit, mixed $background = 'transparent')
 * @method $this removeAnimation(int|string $position = 0)
 * @method bool isAnimated()
 */
interface ImageCacheInterface
{

    /**
     * Create a new image instance
     *
     * @param mixed $data
     * @return $this
     */
    public function make($data);

    /**
     * Set custom property to be included in checksum
     *
     * @param mixed $key
     * @param mixed $value
     * @return $this
     */
    public function setProperty($key, $value);

    /**
     * Returns checksum of current image state
     *
     * @return string
     */
    public function checksum();

    /**
     * Get the processed image
     *
     * @param int|null $lifetime Cache lifetime in minutes
     * @param bool $returnObj Return as Image object or string
     * @return mixed
     */
    public function get($lifetime = null, $returnObj = false);

    /**
     * Process the image operations
     *
     * @return mixed
     */
    public function process();

    /**
     * Magic method to handle image manipulation calls
     * This allows for fluent method chaining like resize(), blur(), etc.
     *
     * @param string $name
     * @param array $arguments
     * @return $this
     */
    public function __call($name, $arguments);
}

function (ImageCacheInterface $image) {
    $image->make('path/to/image.jpg')
        ->resize(300, 200)
        ->greyscale()
        ->blur(5);
};
