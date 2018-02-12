<?php

namespace Violinist\Slug;

class Slug
{

    private $url;

    private $userName;

    private $userRepo;

    private $slug;

    private $provider;

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getUserRepo()
    {
        return $this->userRepo;
    }

    /**
     * @param mixed $userRepo
     */
    public function setUserRepo($userRepo)
    {
        $this->userRepo = $userRepo;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider)
    {
        if (in_array($provider, $this->getSupportedProviders())) {
            $this->provider = $provider;
        }
    }

    /**
     * @return array
     */
    protected function getSupportedProviders()
    {
        return [
          'github.com',
        ];
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public static function getSlugPartsFromProvider($slug, $provider)
    {
        switch ($provider) {
            default:
                return explode('/', $slug);
                break;
        }
    }

    public static function getUsernameFromSlug($slug, $provider)
    {
        $parts = self::getSlugPartsFromProvider($slug, $provider);
        return $parts[0];
    }

    public static function getUserRepoFromSlug($slug, $provider)
    {
        $parts = self::getSlugPartsFromProvider($slug, $provider);
        return $parts[1];
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        if ($this->getProvider()) {
            // Set username and repo based on this.
            $this->setUserName(self::getUsernameFromSlug($slug, $this->provider));
            $this->setUserRepo(self::getUserRepoFromSlug($slug, $this->provider));
        }
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getUserName()
    {
        if (!$this->userName) {
            throw new \Exception('No username found');
        }
        return $this->userName;
    }

    public static function createFromUrl($url)
    {
        $slug = new self();
        $slug->setUrl($url);
        $url = parse_url($url);
        if (!empty($url['host'])) {
            $slug->setProvider($url['host']);
        }
        if (!empty($url['path'])) {
            // It's probably going to start with a slash.
            $path = ltrim($url['path'], '/');
            $slug->setSlug($path);
        }
        return $slug;
    }
}
