<?php

namespace Paulhennell\TwitterAccountInfo\Tests;

use Paulhennell\TwitterAccountInfo\AccountInfo;
use Paulhennell\TwitterAccountInfo\Exceptions\TwitterException;
use Paulhennell\TwitterAccountInfo\TwitterAccountInfo;

class LiveDataTest extends TestCase
{
    /**
     * @test true
     */
    public function true()
    {
        $this->assertTrue(true, 'Well somethings gone horribly wrong');
    }

    /**
     * @test you can get a profile
     */
    public function you_can_get_a_profile_by_name()
    {
        $accountInfo = (new TwitterAccountInfo())->getFromUsername('hennell_dev');

        $this->assertInstanceOf(AccountInfo::class, $accountInfo);
        $this->assertEquals("1261694242067447808", $accountInfo->id);
    }

    /**
     * @test you can get a profile
     */
    public function you_can_get_a_profile_by_id()
    {
        $accountInfo = (new TwitterAccountInfo())->getFromId('1261694242067447808');

        $this->assertInstanceOf(AccountInfo::class, $accountInfo);
        $this->assertEquals("Hennell_dev", $accountInfo->screen_name);
    }

    /**
     * @test an empty profile is empty
     */
    public function an_empty_profile_is_empty()
    {
        $this->expectException(TwitterException::class);
        $accountInfo = (new TwitterAccountInfo())->getFromUsername('realDonaldTrump');
    }
}
