<?php

/*
 * This file is part of bank-card package.
 *
 * (c) emanci <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Emanci\BankCard;

class BankCard
{
    const ALIPAY_GET_CARD_INFO = 'https://ccdcapi.alipay.com/validateAndCacheCardInfo.json';

    const ALIPAY_GET_CARD_LOGO = 'https://apimg.alipay.com/combo.png';

    /**
     * The card number.
     *
     * @var string
     */
    protected $cardNumber;

    /**
     * @var array
     */
    protected $cardType = [
        'CC' => '信用卡',
        'DC' => '储蓄卡',
        'SCC' => '准贷记卡',
        'PC' => '预付费卡',
    ];

    /**
     * BankCard construct.
     *
     * @param string $cardNumber
     */
    public function __construct($cardNumber)
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * Get the bank card info.
     *
     * @return array
     */
    public function info()
    {
        $query = [
            'cardNo' => $this->cardNumber,
            '_input_charset' => 'utf-8',
            'cardBinCheck' => 'true',
        ];

        $url = self::ALIPAY_GET_CARD_INFO.'?'.http_build_query($query);
        $contents = file_get_contents($url);
        $result = json_decode($contents, true);

        if ($result['validated']) {
            return [
                'bank_name' => $this->getBankName($result['bank']),
                'short_code' => $result['bank'],
                'card_type_name' => $this->getCardType($result['cardType']),
                'card_type' => $result['cardType'],
                'BIN' => substr($this->cardNumber, 0, 6),
                'length' => strlen($this->cardNumber),
                'validated' => $result['validated'],
                'logo' => $this->logo($result['bank']),
            ];
        }

        throw new CardBinException($result['messages'][0]['errorCodes']);
    }

    /**
     * Get the logo.
     *
     * @param string $shortCode
     *
     * @return string
     */
    public function logo($shortCode)
    {
        return self::ALIPAY_GET_CARD_LOGO."?d=cashier&t={$shortCode}";
    }

    /**
     * Get the bank name.
     *
     * @param string $shortCode
     *
     * @return string
     */
    protected function getBankName($shortCode)
    {
        $banks = include dirname(__DIR__).'/resources/Banks.php';

        return $this->getFromArray($banks, $shortCode);
    }

    /**
     * Get the card type.
     *
     * @param string $code
     *
     * @return string
     */
    protected function getCardType($code)
    {
        return $this->getFromArray($this->cardType, $code);
    }

    /**
     * Get an item from an array.
     *
     * @param array  $array
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    protected function getFromArray($array, $key, $default = null)
    {
        if (array_key_exists($key, $array)) {
            return $array[$key];
        }

        return $default;
    }
}
