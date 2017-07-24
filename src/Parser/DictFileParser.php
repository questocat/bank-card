<?php

namespace Emanci\BankCard\Parser;

use Emanci\BankCard\BankCard;

class DictFileParser extends AbstractParser
{
    /**
     * {@inheritdoc}.
     */
    protected function getCardInfo()
    {
        $cardBinMap = $this->getCardBinMap();

        foreach ($cardBinMap as $bank) {
            foreach ($bank['patterns'] as $pattern) {
                unset($bank['patterns']);
                if (preg_match($pattern['reg'], $this->cardNumber, $matches)) {
                    return array_merge($bank, [
                        'type' => $pattern['type'],
                        'bin' => $matches[1],
                    ]);
                }
            }
        }

        // CARD_BIN_NOT_MATCH
        return [];
    }

    /**
     * {@inheritdoc}.
     */
    protected function mapCardInfoToObject(array $original)
    {
        $cardInfo = [
            'validated' => false,
        ];

        if ($original) {
            $cardInfo = [
                'shortCode' => $original['code'],
                'bankName' => $this->getBankName($original['code']),
                'cardType' => $original['type'],
                'cardTypeName' => $this->getCardType($original['type']),
                'logo' => $this->getLogo($original['code']),
                'smallLogo' => $this->getSmallLogo($original['code']),
                'base64Logo' => $this->getBase64Logo($original['code']),
                'cardNumber' => $this->cardNumber,
                'cardFormat' => card_format($this->cardNumber),
                'cardBin' => $original['bin'],
                'validated' => true,
                'luhn' => $this->luhn()->verify($this->cardNumber),
            ];
        }

        return (new BankCard())->setRaw($original)->map($cardInfo);
    }

    /**
     * Returns the card bin map.
     *
     * @return array
     */
    protected function getCardBinMap()
    {
        return include dirname(dirname(__DIR__)).'/resources/CardBin.php';
    }
}
