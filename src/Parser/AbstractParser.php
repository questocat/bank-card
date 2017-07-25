<?php

namespace Emanci\BankCard\Parser;

use Emanci\BankCard\BankCard;
use Emanci\BankCard\LuhnTrait;

abstract class AbstractParser
{
    use LuhnTrait;

    /**
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

    const API_GET_CARD_LOGO = 'https://apimg.alipay.com/combo.png';

    /**
     * AbstractParser construct.
     *
     * @param string $cardNumber
     */
    public function __construct($cardNumber)
    {
        $this->setCardNumber($cardNumber);
    }

    /**
     * Set the bank card number.
     *
     * @param string $cardNumber
     *
     * @return $this
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * Returns the bank card info.
     *
     * @return array
     */
    abstract protected function getCardInfo();

    /**
     * Map the raw card info array to a BankCard instance.
     *
     * @param array $original
     *
     * @return BankCard
     */
    abstract protected function mapCardInfoToObject(array $original);

    /**
     * Returns the bank card logo.
     *
     * @param string $shortCode
     *
     * @return string
     */
    public function getLogo($shortCode)
    {
        return self::API_GET_CARD_LOGO."?d=cashier&t={$shortCode}";
    }

    /**
     * Returns the small logo data URI.
     *
     * @param string $shortCode
     *
     * @return string
     */
    public function getSmallLogo($shortCode)
    {
        $smallLogoMap = include dirname(dirname(__DIR__)).'/resources/SmallLogo.php';

        return array_get($smallLogoMap, $shortCode);
    }

    /**
     * Returns the data URI.
     *
     * @param string $shortCode
     *
     * @return string
     */
    public function getBase64Logo($shortCode)
    {
        $LogoMap = include dirname(dirname(__DIR__)).'/resources/Logo.php';

        return array_get($LogoMap, $shortCode);
    }

    /**
     * Returns the BankCard instance.
     *
     * @return BankCard
     */
    public function bankCard()
    {
        $cardInfo = $this->getCardInfo();

        return $this->mapCardInfoToObject($cardInfo);
    }

    /**
     * Returns the bank card name.
     *
     * @param string $shortCode
     *
     * @return string
     */
    protected function getBankName($shortCode)
    {
        $banks = include dirname(dirname(__DIR__)).'/resources/Banks.php';

        return array_get($banks, $shortCode);
    }

    /**
     * @param string $code
     *
     * @return mixed
     */
    protected function getCardType($code)
    {
        return array_get($this->cardType, $code);
    }
}
