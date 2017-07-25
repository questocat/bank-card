<?php

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
