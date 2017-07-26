<?php

namespace Tests;

use Emanci\BankCard\Luhn;

class LuhnTest extends TestCase
{
    protected $luhn;

    public function setUp()
    {
        $this->luhn = new Luhn();
    }

    public function testVerify()
    {
        $cardNumberList = [
            '620043459807747764',   // wrong
            '620043459807747763',   // right
        ];

        $this->assertFalse($this->luhn->verify($cardNumberList[0]));
        $this->assertTrue($this->luhn->verify($cardNumberList[1]));
    }

    public function testCalculateCheckDigit()
    {
        $cardNumber = '62004345980774776';   // 不含校验码

        $this->assertEquals(3, $this->luhn->calculateCheckDigit($cardNumber));
    }
}
