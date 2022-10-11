<?php

namespace Paulhennell\TwitterAccountInfo;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;

class TwitterAccountInfo
{
    private HttpClient $httpClient;
    private RequestFactory $requestFactory;

    public function __construct(HttpClient $httpClient = null, RequestFactory $requestFactory = null)
    {
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
    }

    public function getFromUsername(string $username): AccountInfo
    {
        return $this->loadFrom("https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names=$username");
    }

    public function getFromId(string $account_id): AccountInfo
    {
        return $this->loadFrom("https://cdn.syndication.twimg.com/widgets/followbutton/info.json?user_ids=$account_id");
    }

    private function loadFrom($url)
    {
        return AccountInfo::fromJson($this->makeRequest($url)->getBody()->getContents());
    }

    private function makeRequest($url)
    {
        $response = $this->httpClient->sendRequest($this->requestFactory->createRequest("GET", $url));

        if ($response->getStatusCode() == 200) {
            return $response;
        } else {
            throw new \Exception($response->getBody());
        }
    }
}
