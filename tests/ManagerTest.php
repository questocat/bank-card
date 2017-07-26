<?php

namespace Tests;

use Emanci\BankCard\BankCardInterface;
use Emanci\BankCard\Manager;
use Emanci\BankCard\Parser\AbstractParser;

class ManagerTest extends TestCase
{
    protected $manager;

    public function setUp()
    {
        $this->manager = new Manager('620043459807747768');
    }

    public function testParser()
    {
        $this->assertInstanceOf(AbstractParser::class, $this->manager->parser());
    }

    public function testDictFileParserBankCard()
    {
        $this->assertInstanceOf(AbstractParser::class, $dictFileParser = $this->manager->parser('dictFile'));
        $this->assertInstanceOf(BankCardInterface::class, $dictFileParser->bankCard());
        $this->assertInstanceOf(BankCardInterface::class, $dictFileParser->setCardNumber('621043459807747768')->bankCard());
    }

    public function testAlipayParserBankCard()
    {
        $this->assertInstanceOf(BankCardInterface::class, $this->manager->bankCard());
    }

    public function testLogo()
    {
        $this->assertSame('https://apimg.alipay.com/combo.png?d=cashier&t=ABC', $this->manager->getLogo('ABC'));
    }
}
