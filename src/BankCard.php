<?php

namespace Emanci\BankCard;

class BankCard implements BankCardInterface
{
    /**
     * The bankCard's card number.
     *
     * @var string
     */
    protected $cardNumber;

    /**
     * The bankCard's card format text.
     *
     * @var string
     */
    protected $cardFormat;

    /**
     * The bankCard's bank name.
     *
     * @var string
     */
    protected $bankName;

    /**
     * The bankCard's short code.
     *
     * @var string
     */
    protected $shortCode;

    /**
     * The bankCard's card BIN.
     *
     * @var string
     */
    protected $cardBin;

    /**
     * The bankCard's logo.
     *
     * @var string
     */
    protected $logo;

    /**
     * The bankCard's small logo.
     *
     * @var string
     */
    protected $smallLogo;

    /**
     * The bankCard's base64 logo.
     *
     * @var string
     */
    protected $base64Logo;

    /**
     * The bankCard's card type.
     *
     * @var string
     */
    protected $cardType;

    /**
     * The bankCard's card type name.
     *
     * @var string
     */
    protected $cardTypeName;

    /**
     * The bankCard's card BIN verify.
     *
     * @var string
     */
    protected $validated;

    /**
     * The bankCard's luhn verify.
     *
     * @var string
     */
    protected $luhn;

    /**
     * The bankCard's original data.
     *
     * @var string
     */
    protected $original;

    /**
     * Get the card number of the bankCard.
     *
     * @return string
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * Get the card format text of the bankCard.
     *
     * @return string
     */
    public function getCardFormat()
    {
        return $this->cardFormat;
    }

    /**
     * Get the bank name of the bankCard.
     *
     * @return string
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * Get the short code of the bankCard.
     *
     * @return string
     */
    public function getShortCode()
    {
        return $this->shortCode;
    }

    /**
     * Get the card bin of the bankCard.
     *
     * @return string
     */
    public function getCardBin()
    {
        return $this->cardBin;
    }

    /**
     * Get the logo of the bankCard.
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Get the small logo of the bankCard.
     *
     * @return string
     */
    public function getSmallLogo()
    {
        return $this->smallLogo;
    }

    /**
     * Get the base64 logo of the bankCard.
     *
     * @return string
     */
    public function getBase64Logo()
    {
        return $this->base64Logo;
    }

    /**
     * Get the card type of the bankCard.
     *
     * @return string
     */
    public function getCardType()
    {
        return $this->cardType;
    }

    /**
     * Get the card type name of the bankCard.
     *
     * @return string
     */
    public function getCardTypeName()
    {
        return $this->cardTypeName;
    }

    /**
     * Get the validated of the bankCard.
     *
     * @return string
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * Get the luhn of the bankCard.
     *
     * @return string
     */
    public function getLuhn()
    {
        return $this->luhn;
    }

    /**
     * Get the original of the bankCard.
     *
     * @return string
     */
    public function getRaw()
    {
        return $this->original;
    }

    /**
     * Set the raw original array.
     *
     * @param array $original
     *
     * @return $this
     */
    public function setRaw(array $original)
    {
        $this->original = $original;

        return $this;
    }

    /**
     * Map the given array onto the bankCard's properties.
     *
     * @param array $attributes
     *
     * @return $this
     */
    public function map(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->{$key} = $value;
        }

        return $this;
    }
}
