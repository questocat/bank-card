<?php

/*
 * This file is part of questocat/bank-card package.
 *
 * (c) questocat <zhengchaopu@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Questocat\BankCard;

trait LuhnTrait
{
    /**
     * @var Luhn
     */
    protected $luhn;

    /**
     * @return Luhn
     */
    public function luhn()
    {
        if (null === $this->luhn) {
            $this->luhn = new Luhn();
        }

        return $this->luhn;
    }
}
