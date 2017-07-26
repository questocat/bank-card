<?php

namespace Tests;

use Emanci\BankCard\BankCard;
use Emanci\BankCard\Parser\AbstractParser;

class ParserTestStub extends AbstractParser
{
    /**
     * {@inheritdoc}.
     */
    protected function getCardInfo()
    {
        return [
            'code' => 'ICBC',
            'type' => 'DC',
            'bin' => '620200',
        ];
    }

    /**
     * {@inheritdoc}.
     */
    protected function mapCardInfoToObject(array $original)
    {
        $cardInfo = [
            'shortCode' => $original['code'],
            'bankName' => '中国工商银行',
            'cardType' => $original['type'],
            'cardTypeName' => '储蓄卡',
            'logo' => $original['code'],
            'smallLogo' => $original['code'],
            'base64Logo' => $original['code'],
            'cardNumber' => $this->cardNumber,
            'length' => strlen($this->cardNumber),
            'cardFormat' => $this->cardNumber,
            'cardBin' => $original['bin'],
            'validated' => true,
            'luhn' => false,
        ];

        return (new BankCard())->setRaw($original)->map($cardInfo);
    }
}
