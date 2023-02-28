<?php

namespace Paulhennell\TwitterAccountInfo;

use Http\Client\HttpClient;
use Http\Discovery\HttpClientDiscovery;
use Http\Discovery\MessageFactoryDiscovery;
use Http\Message\RequestFactory;
use Paulhennell\TwitterAccountInfo\Exceptions\TwitterException;
use Paulhennell\TwitterAccountInfo\Nitter\NitterParser;
use Paulhennell\TwitterAccountInfo\Nitter\NitterUrlInterface;
use Paulhennell\TwitterAccountInfo\Nitter\RandomNitterUrl;

class TwitterAccountInfo
{
    private HttpClient $httpClient;
    private RequestFactory $requestFactory;

    public function __construct(HttpClient $httpClient = null, RequestFactory $requestFactory = null)
    {
        $this->httpClient = $httpClient ?: HttpClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: MessageFactoryDiscovery::find();
    }

    public function getFromUsername(string $username, null|string|NitterUrlInterface $nitterUrl = null): AccountInfo
    {
        $url = $this->makeNitterUrl($username, $nitterUrl);
        return (new NitterParser())->getAccountInfo($this->makeRequest($url)->getBody()->getContents());
    }

    private function makeNitterUrl(string $username, null|string|NitterUrlInterface $nitterUrl) : string
    {
        if (is_string($nitterUrl)) {
            return $nitterUrl . "/$username";
        }
        $nitterUrl = $nitterUrl ?? RandomNitterUrl::class;
        return $nitterUrl::getUrl() . "/$username";

    }

    private function makeRequest($url)
    {
        $response = $this->httpClient->sendRequest($this->requestFactory->createRequest("GET", $url));

        if ($response->getStatusCode() == 200) {
            return $response;
        } elseif ($response->getStatusCode() == 404) {
            throw new TwitterException("Account does not exist");
        } else {
            throw new \Exception($response->getBody());
        }
    }
}
