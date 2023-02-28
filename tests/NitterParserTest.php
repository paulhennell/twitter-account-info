<?php

namespace Paulhennell\TwitterAccountInfo\Tests;

use Paulhennell\TwitterAccountInfo\Nitter\NitterParser;
use PHPUnit\Framework\TestCase;

class NitterParserTest extends TestCase
{
    /**
     * @test test you can get an account info back from snapshotted html
     */
    public function test_you_can_get_an_account_info_back()
    {
        $accountInfo = (new NitterParser())->getAccountInfo(file_get_contents(__DIR__.'/TestData/test_data.html'));

        $this->assertEquals('@Hennell_dev', $accountInfo->screen_name);
        $this->assertEquals('Paul Hennell • Dev', $accountInfo->name);
        $this->assertEquals('1025', $accountInfo->tweet_count);
        $this->assertEquals('384', $accountInfo->following_count);
        $this->assertEquals('97', $accountInfo->followers_count);
        $this->assertEquals('2161', $accountInfo->likes_count);

    }
}
