<?php

namespace Violinist\tests;

use PHPUnit\Framework\TestCase;
use Violinist\Slug\Slug;

class SlugTest extends TestCase
{
    public function testCanCreateStatically()
    {
        $slug = Slug::createFromUrl('https://github.com/violinist-dev/slug-from-url');
        $this->checkExpectedOutputFromSelfRepo($slug);
    }

    public function testNonSupportedProvider()
    {
        $slug = Slug::createFromUrl('http://example.com');
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('No username found');
        $slug->getUserName();
        $this->assertEquals(null, $slug->getProvider());
    }

    public function testcreateStaticallyFromSupportedProviders()
    {
        $slug = Slug::createFromUrlAndSupportedProviders('https://example.com/violinist-dev/slug-from-url', ['example.com']);
        $this->checkExpectedOutputFromSelfRepo($slug, 'example.com');
    }

    public function testcreateStaticallyFromUnSupportedProviders()
    {
        $slug = Slug::createFromUrlAndSupportedProviders('https://example.com/violinist-dev/slug-from-url', ['example.org']);
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('No username found');
        $slug->getUserName();
        $this->assertEquals(null, $slug->getProvider());
    }

    protected function checkExpectedOutputFromSelfRepo(Slug $slug, $host = 'github.com')
    {
        $this->assertEquals('slug-from-url', $slug->getUserRepo());
        $this->assertEquals($host, $slug->getProvider());
        $this->assertEquals('violinist-dev/slug-from-url', $slug->getSlug());
        $this->assertEquals('violinist-dev', $slug->getUserName());
        $this->assertEquals("https://$host/violinist-dev/slug-from-url", $slug->getUrl());
    }
}
