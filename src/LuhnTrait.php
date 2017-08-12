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

trait LuhnTrait
{
    protected $luhn;

    public function luhn()
    {
        if (is_null($this->luhn)) {
            $this->luhn = new Luhn();
        }

        return $this->luhn;
    }
}
