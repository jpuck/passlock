<?php

use PHPUnit\Framework\TestCase;

use gpgl\core\History;

class HistoryTest extends TestCase
{
    public function test_instantiates_history_class()
    {
        $chain = [
            '2017-05-18T18:28:33+00:00' => 'b0fa0ed340041483887c9939cc16e95e307236f9',
            '2017-05-19T22:15:13+00:00' => '5f4ef154260613cb53788d9974f6fb9bf9b6f98e',
            '2017-05-21T02:01:53+00:00' => '8c71b7da47c90be3c7c0dc9f7e30d0cc6ca3010c',
            '2017-05-22T05:48:33+00:00' => 'f0421b1dda0fd3326280fb2fe9ae0c8ab3b4629b',
            '2017-05-23T09:35:13+00:00' => '7b7b92ae20d3e365a75a96bd3c840d4b51f55025',
            '2017-05-24T13:21:53+00:00' => 'b5a7f3507359dc38b69872b87bda0e9d96448448',
            '2017-05-25T17:08:33+00:00' => '3ef6612fb10a6893dbf037c2efa2cd07c38fd9fe',
            '2017-05-26T20:55:13+00:00' => '9392fd503334832fb49bdd245970510192d03079',
            '2017-05-28T00:41:53+00:00' => '930882482c959f29c2f4b5dd67925c811bf5d9c6',
        ];

        $history = new History($chain);

        $this->assertInstanceOf(History::class, $history);
    }

    public function test_instantiates_history_class_with_json()
    {
        $chain = json_encode([
            '2017-05-18T18:28:33+00:00' => 'b0fa0ed340041483887c9939cc16e95e307236f9',
            '2017-05-19T22:15:13+00:00' => '5f4ef154260613cb53788d9974f6fb9bf9b6f98e',
            '2017-05-21T02:01:53+00:00' => '8c71b7da47c90be3c7c0dc9f7e30d0cc6ca3010c',
            '2017-05-22T05:48:33+00:00' => 'f0421b1dda0fd3326280fb2fe9ae0c8ab3b4629b',
            '2017-05-23T09:35:13+00:00' => '7b7b92ae20d3e365a75a96bd3c840d4b51f55025',
            '2017-05-24T13:21:53+00:00' => 'b5a7f3507359dc38b69872b87bda0e9d96448448',
            '2017-05-25T17:08:33+00:00' => '3ef6612fb10a6893dbf037c2efa2cd07c38fd9fe',
            '2017-05-26T20:55:13+00:00' => '9392fd503334832fb49bdd245970510192d03079',
            '2017-05-28T00:41:53+00:00' => '930882482c959f29c2f4b5dd67925c811bf5d9c6',
        ]);

        $history = new History($chain);

        $this->assertInstanceOf(History::class, $history);
    }

    /**
     * @expectedException \gpgl\core\Exceptions\InvalidHistoryChain
     */
    public function test_rejects_object()
    {
        $object = new \StdClass;

        $history = new History($object);

        $this->assertTrue(false);
    }
}
