<?php

namespace Emanci\BankCard;

class BankCard
{
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
    ];

    const ALIPAY_GET_CARD_INFO = 'https://ccdcapi.alipay.com/validateAndCacheCardInfo.json';

    const ALIPAY_GET_CARD_LOGO = 'https://apimg.alipay.com/combo.png';

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
     * Get the logo.
     *
     * @return string
     */
    public function logo()
    {
        return self::ALIPAY_GET_CARD_LOGO."?d=cashier&t={$this->cardNumber}";
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
                'validated' => $result['validated'],
                'logo' => $this->logo(),
            ];
        }

        throw new CardBinException($result['messages'][0]['errorCodes']);
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
        $map = include dirname(__DIR__).'/resources/BankList.php';

        return $this->getFromArray($map, $shortCode);
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
