<?php

namespace Emanci\BankCard;

interface BankCardInterface
{
    /**
     * Get the card number of the bankCard.
     *
     * @return string
     */
    public function getCardNumber();

    /**
     * Get the card format text of the bankCard.
     *
     * @return string
     */
    public function getCardFormat();

    /**
     * Get the bank name of the bankCard.
     *
     * @return string
     */
    public function getBankName();

    /**
     * Get the short code of the bankCard.
     *
     * @return string
     */
    public function getShortCode();

    /**
     * Get the card bin of the bankCard.
     *
     * @return string
     */
    public function getCardBin();

    /**
     * Get the logo of the bankCard.
     *
     * @return string
     */
    public function getLogo();

    /**
     * Get the small logo of the bankCard.
     *
     * @return string
     */
    public function getSmallLogo();

    /**
     * Get the base64 logo of the bankCard.
     *
     * @return string
     */
    public function getBase64Logo();

    /**
     * Get the card type of the bankCard.
     *
     * @return string
     */
    public function getCardType();

    /**
     * Get the card type name of the bankCard.
     *
     * @return string
     */
    public function getCardTypeName();

    /**
     * Get the validated of the bankCard.
     *
     * @return string
     */
    public function getValidated();

    /**
     * Get the luhn of the bankCard.
     *
     * @return string
     */
    public function getLuhn();

    /**
     * Get the original of the bankCard.
     *
     * @return string
     */
    public function getRaw();
}
