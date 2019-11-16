<?php

namespace Tests\Unit;

use Tests\CreatesApplication;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class ExampleTest extends BaseTestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    use CreatesApplication;
    public $baseUrl = 'http://localhost';
    public function testSearch()
    {
        $this->visit('/')
            ->type('it\'s the end of the world as we know it', 'search-box')
            ->press('submit')
            ->seePageIs('/search') // Hooray, we got to the search. Lets see if the songs are there
            ->see('It\'s The End Of The World As We Know It (And I Feel Fine)'); // Yup, they're there. Test succeeded.
    }
    public function testNullQuery()
    {
        $this->visit('/')
            ->press('submit')
            ->seePageIs('/search')
            ->see('Interloper'); // It didn't crash, and showed us the default search results.
    }
    public function testWeirdQuery()
    {
        $this->visit('/')
            ->type('表ポあA鷗ŒéＢ逍Üßªąñ丂㐀𠀀', 'search-box')
            ->press('submit')
            ->seePageIs('/search') // Well, we got to the search, but did it crash?
            ->see('Songs'); // We didn't crash. Thanks laravel!
    }
    public function testNoImageQuery()
    {
        $this->visit('/')
            ->type('Piano Man', 'search-box')
            ->press('submit')
            ->seePageIs('/search') // Well, we got to the search, but did it crash?
            ->see('Songs'); // We didn't crash as we replaced the bad image with a placeholder. Hopefully, anyway.
    }
}
