<?php

namespace Paulhennell\TwitterAccountInfo;

use Paulhennell\TwitterAccountInfo\Exceptions\TwitterException;
use voku\helper\HtmlDomParser;

class AccountInfo
{
    public function __construct(
        public readonly string $screen_name,
        public readonly string $name,
        public readonly int $following_count,
        public readonly int $followers_count,
        public readonly int $tweet_count,
        public readonly int $likes_count,
    ) {
    }
}
