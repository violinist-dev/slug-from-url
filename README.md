# slug-from-url
Get a slug from a URL

[![Coverage Status](https://coveralls.io/repos/github/violinist-dev/slug-from-url/badge.svg)](https://coveralls.io/github/violinist-dev/slug-from-url)
[![Build Status](https://travis-ci.org/violinist-dev/slug-from-url.svg?branch=master)](https://travis-ci.org/violinist-dev/slug-from-url)

## Installation

```
composer require violinist-dev/slug-from-url
```

## Usage

```php
<?php

use Violinist\Slug\Slug;

// Probably uou want to use this directly from a URL somehow. Like so:
$slug = Slug::createFromUrl('https://github.com/violinist-dev/slug-from-url');
// Maybe you want the github slug:
$gh_slug = $slug->getSlug();       // Returns violinist-dev/slug-from-url
// Or maybe you want to get the username:
$username = $slug->getUserName();  // Returns violinist-dev
// ...or here is the repo name.
$repo = $slug->getUserRepo();      // Returns slug-from-url
```

## Licence

MIT
