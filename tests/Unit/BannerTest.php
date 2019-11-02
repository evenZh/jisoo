<?php


namespace Tests\Unit;


use App\Models\Banner;
use Tests\TestCase;

class BannerTest extends TestCase
{
    /**
     * @group FuncA
     */
    public function testA()
    {
        \Log::info('this is FuncA');
        $banner = Banner::query()->first();
        \Log::info($banner);
        $this->assertTrue(true);
    }

    /**
     * @group FuncB
     */
    public function testB()
    {
        \Log::info('this is FuncB');
        $this->assertTrue(true);
    }

}
