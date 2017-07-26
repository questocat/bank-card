<?php

namespace Emanci\BankCard\Parser;

use Emanci\BankCard\BankCard;

class AlipayParser extends AbstractParser
{
    const ALIPAY_GET_CARD_INFO = 'https://ccdcapi.alipay.com/validateAndCacheCardInfo.json';

    /**
     * {@inheritdoc}.
     */
    protected function getCardInfo()
    {
        $query = [
            'cardNo' => $this->cardNumber,
            '_input_charset' => 'utf-8',
            'cardBinCheck' => 'true',
        ];

        $url = self::ALIPAY_GET_CARD_INFO.'?'.http_build_query($query);
        $contents = file_get_contents($url);

        return json_decode($contents, true);
    }

    /**
     * {@inheritdoc}.
     */
    protected function mapCardInfoToObject(array $original)
    {
        $cardInfo = [
            'validated' => false,
        ];

        if ($original['validated']) {
            $cardInfo = [
                'shortCode' => $original['bank'],
                'bankName' => $this->getBankName($original['bank']),
                'cardType' => $original['cardType'],
                'cardTypeName' => $this->getCardType($original['cardType']),
                'logo' => $this->getLogo($original['bank']),
                'smallLogo' => $this->getSmallLogo($original['bank']),
                'base64Logo' => $this->getBase64Logo($original['bank']),
                'cardNumber' => $this->cardNumber,
                'length' => strlen($this->cardNumber),
                'cardFormat' => card_format($this->cardNumber),
                'cardBin' => card_bin($this->cardNumber),
                'validated' => true,
                'luhn' => $this->luhn()->verify($this->cardNumber),
            ];
        }

        return (new BankCard())->setRaw($original)->map($cardInfo);
    }
}
