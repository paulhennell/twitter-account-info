<?php

namespace Paulhennell\TwitterAccountInfo\Nitter;

use Paulhennell\TwitterAccountInfo\AccountInfo;
use voku\helper\HtmlDomParser;

class NitterParser
{
    public function getAccountInfo(string $nitter_html) : AccountInfo
    {
        $dom = HtmlDomParser::str_get_html($nitter_html);

        return new AccountInfo(
            screen_name: $dom->findOne('.profile-card-username')->text(),
            name: $dom->findOne('.profile-card-fullname')->text(),
            following_count: $this->unformatNumber($dom->findOne('li.following .profile-stat-num')->text()),
            followers_count: $this->unformatNumber($dom->findOne('li.followers .profile-stat-num')->text()),
            tweet_count: $this->unformatNumber($dom->findOne('li.posts .profile-stat-num')->text()),
            likes_count: $this->unformatNumber($dom->findOne('li.likes .profile-stat-num')->text()),
        );
    }

    private function unformatNumber(string $number) : int
    {
        return filter_var($number, FILTER_SANITIZE_NUMBER_INT);
    }
}
