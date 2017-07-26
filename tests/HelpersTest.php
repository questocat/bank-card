<?php

namespace Tests;

class HelpersTest extends TestCase
{
    public function testArrayGet()
    {
        $arr = [
            'a' => 1,
            'b' => 2,
            'c' => [
                'c1' => 'c1',
                'c2' => 'c2',
                ],
        ];
        $this->assertEquals(1, array_get($arr, 'a'));
        $this->assertEquals('c2', array_get($arr, 'c.c2'));
        $this->assertEquals('d', array_get($arr, 'd', 'd'));
        $this->assertArraySubset(array_get($arr, null), $arr);
    }

    public function testCardFormat()
    {
        $this->assertSame('6202 0001 2358 6950 12', card_format('620200012358695012'));
    }
}
