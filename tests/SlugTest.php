<?php

namespace Violinist\tests;

use PHPUnit\Framework\TestCase;
use Violinist\Slug\Slug;

class SlugTest extends TestCase
{
    public function testCanCreateStatically()
    {
        $slug = Slug::createFromUrl('https://github.com/violinist-dev/slug-from-url');
        $this->assertEquals('slug-from-url', $slug->getUserRepo());
        $this->assertEquals('github.com', $slug->getProvider());
        $this->assertEquals('violinist-dev/slug-from-url', $slug->getSlug());
        $this->assertEquals('violinist-dev', $slug->getUserName());
        $this->assertEquals('https://github.com/violinist-dev/slug-from-url', $slug->getUrl());
    }

    public function testNonSupportedProvider()
    {
        $slug = Slug::createFromUrl('http://example.com');
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('No username found');
        $slug->getUserName();
        $this->assertEquals(null, $slug->getProvider());
    }
}
