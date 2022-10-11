<?php

namespace Paulhennell\TwitterAccountInfo;

use Paulhennell\TwitterAccountInfo\Exceptions\TwitterException;

class AccountInfo
{
    public function __construct(
        public readonly bool $following,
        public readonly string $id,
        public readonly string $screen_name,
        public readonly string $name,
        public readonly bool $protected,
        public readonly int $followers_count,
        public readonly string $formatted_followers_count,
        public readonly bool $age_gated,
    ) {
    }

    /**
     * @throws TwitterException
     */
    public static function fromJson(string $json)
    {
        if ($json == "[]") {
            throw new TwitterException("Account doesn't exist or has been suspended");
        }
        $data = json_decode($json, false)[0];

        return new self(
            $data->following,
            $data->id,
            $data->screen_name,
            $data->name,
            $data->protected,
            $data->followers_count,
            $data->formatted_followers_count,
            $data->age_gated,
        );
    }
}
