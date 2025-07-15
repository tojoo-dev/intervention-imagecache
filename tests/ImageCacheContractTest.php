<?php

namespace Intervention\Image\Test;

use Intervention\Image\Interfaces\ImageCacheInterface;
use Intervention\Image\ImageCache;
use PHPUnit\Framework\TestCase;

class ImageCacheContractTest extends TestCase
{
    public function testImageCacheImplementsContract()
    {
        $imageCache = new ImageCache();

        $this->assertInstanceOf(ImageCacheInterface::class, $imageCache);
    }

    public function testContractMethodsExist()
    {
        $reflection = new \ReflectionClass(ImageCache::class);

        // Test that all interface methods are implemented
        $this->assertTrue($reflection->hasMethod('make'));
        $this->assertTrue($reflection->hasMethod('setProperty'));
        $this->assertTrue($reflection->hasMethod('checksum'));
        $this->assertTrue($reflection->hasMethod('get'));
        $this->assertTrue($reflection->hasMethod('process'));
        $this->assertTrue($reflection->hasMethod('__call'));
    }

    public function testMethodChaining()
    {
        $imageCache = new ImageCache();

        // Test that methods return the same instance for chaining
        $result1 = $imageCache->setProperty('test', 'value');
        $this->assertSame($imageCache, $result1);

        $result2 = $imageCache->make('test_data');
        $this->assertSame($imageCache, $result2);
    }
}
