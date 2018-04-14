<?php

/*
 * This file is part of bank-card package.
 *
 * (c) emanci <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Questocat\BankCard;

/**
 * Luhn 算法.
 *
 * @see https://zh.wikipedia.org/wiki/Luhn%E7%AE%97%E6%B3%95
 */
class Luhn
{
    /**
     * Verify the check digit.
     *
     * @param string cardNumber
     *
     * @return bool
     */
    public function verify($cardNumber)
    {
        $originalCardNumber = $this->prepare($cardNumber);

        $cardNumber = $this->excludeCheckDigit($originalCardNumber);

        $luhmSum = $this->calculateLuhmSum($cardNumber);

        $checkCode = $this->checkDigit($originalCardNumber);

        if (0 === ($luhmSum + $checkCode) % 10) {
            return true;
        }

        return false;
    }

    /**
     * Calculate the check digit.
     *
     * @param string $number
     *
     * @return string
     */
    public function calculateCheckDigit($number)
    {
        $luhmSum = $this->calculateLuhmSum($number);

        return 10 - ($luhmSum % 10);
    }

    /**
     * Prepare the bank card number.
     *
     * @param string $cardNumber
     *
     * @return string
     */
    protected function prepare($cardNumber)
    {
        $cardNumber = str_replace(' ', '', trim($cardNumber));

        return $cardNumber;
    }

    /**
     * Returns the check digit of card number.
     *
     * @param string $cardNumber
     *
     * @return int
     */
    protected function checkDigit($cardNumber)
    {
        return substr($cardNumber, -1);
    }

    /**
     * Returns the no check digit of card number.
     *
     * @param string $cardNumber
     *
     * @return string
     */
    protected function excludeCheckDigit($cardNumber)
    {
        return substr($cardNumber, 0, -1);
    }

    /**
     * Calculate the Luhm checksum.
     *
     * @param string $number
     *
     * @return int
     */
    protected function calculateLuhmSum($number)
    {
        $len = strlen($number);
        $luhmSum = 0;
        $j = 1;

        for ($i = $len - 1; $i >= 0; --$i) {
            $k = intval($number[$i]);
            if ($j % 2 == 1) {
                $k *= 2;
                $k = intval($k / 10) + $k % 10;
            }

            $luhmSum += $k;
            ++$j;
        }

        return $luhmSum;
    }
}
