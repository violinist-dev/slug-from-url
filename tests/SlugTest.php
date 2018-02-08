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
}
