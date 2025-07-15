<?php

namespace Intervention\Image\Test;

use Intervention\Image\CachedImage;
use Intervention\Image\ImageManager;
use PHPUnit\Framework\TestCase;

class CachedImageTest extends TestCase
{
    public function testSetFromOriginal()
    {
        $manager = ImageManager::gd();
        $image = $manager->create(100, 100);

        $cachedImage = new CachedImage();
        $cachedImage->setFromOriginal($image, 'foo-key');

        $this->assertEquals('foo-key', $cachedImage->cachekey);
        $this->assertEquals(100, $cachedImage->width());
        $this->assertEquals(100, $cachedImage->height());
        $this->assertSame($image, $cachedImage->getImage());
    }
}
