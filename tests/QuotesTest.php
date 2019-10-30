<?php

/**
 * Class QuotesTest
 */
class QuotesTest extends TestCase
{
    /** test **/
    public function testShoutedQuotes()
    {
        $this->get('/shout/steve-jobs?limit=2')
            ->seeJsonEquals([
                "YOUR TIME IS LIMITED, SO DON’T WASTE IT LIVING SOMEONE ELSE’S LIFE!",
                "THE ONLY WAY TO DO GREAT WORK IS TO LOVE WHAT YOU DO!"
            ]);
    }

    /** test **/
    public function testShoutedQuotesWithoutLimit()
    {
        $this->get('/shout/steve-jobs')
            ->seeJsonEquals([
                "YOUR TIME IS LIMITED, SO DON’T WASTE IT LIVING SOMEONE ELSE’S LIFE!",
                "THE ONLY WAY TO DO GREAT WORK IS TO LOVE WHAT YOU DO!"
            ]);
    }

    /** test **/
    public function testShoutedQuotesSliced()
    {
        $this->get('/shout/steve-jobs?limit=1')
            ->seeJsonEquals([
                "YOUR TIME IS LIMITED, SO DON’T WASTE IT LIVING SOMEONE ELSE’S LIFE!"
            ]);
    }

    /** test **/
    public function testShoutedQuotesWrongAuthor()
    {
        $this->get('/shout/dummy-author')
            ->seeJsonEquals([]);
    }

    /** test **/
    public function testWrongLimit()
    {
        $response = $this->call('GET', '/shout/steve-jobs?limit=12');

        $this->assertEquals(422, $response->status());
    }
}
