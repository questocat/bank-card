<?php

namespace Tests;

use Emanci\BankCard\BankCardInterface;

class ParserTest extends TestCase
{
    protected $parser;

    public function setUp()
    {
        $this->parser = new ParserTestStub('620200012358695012');
    }

    public function testBankCard()
    {
        $bankCard = $this->parser->bankCard();

        $this->assertInstanceOf(BankCardInterface::class, $bankCard);
        $this->assertSame('ICBC', $bankCard->getShortCode());

        $this->assertSame('620200012358695012', $bankCard->getCardNumber());
        $this->assertSame('620200012358695012', $bankCard->getCardFormat());
        $this->assertSame(18, $bankCard->getLength());
        $this->assertSame('中国工商银行', $bankCard->getBankName());
        $this->assertSame('620200', $bankCard->getCardBin());
        $this->assertSame('ICBC', $bankCard->getLogo());
        $this->assertSame('ICBC', $bankCard->getSmallLogo());
        $this->assertSame('ICBC', $bankCard->getBase64Logo());
        $this->assertSame('DC', $bankCard->getCardType());
        $this->assertSame('储蓄卡', $bankCard->getCardTypeName());

        $this->assertTrue($bankCard->getValidated());
        $this->assertFalse($bankCard->getLuhn());

        $raw = $bankCard->getRaw();
        $this->assertArrayHasKey('code', $raw);
        $this->assertContains('ICBC', $raw);

        $this->assertArrayHasKey('type', $raw);
        $this->assertContains('DC', $raw);

        $this->assertArrayHasKey('bin', $raw);
        $this->assertContains('620200', $raw);
    }
}
