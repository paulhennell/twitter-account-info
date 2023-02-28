<?php

namespace Paulhennell\TwitterAccountInfo\Nitter;

class RandomNitterUrl implements NitterUrlInterface
{
    private const URLS = [
        'https://nitter.net',
        'https://nitter.it',
        'https://nitter.nl',
        'https://nitter.ir',
    ];
    public static function getUrl() : string
    {
        return self::URLS[array_rand(self::URLS, 1)];
    }
}
