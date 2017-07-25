<?php

namespace Emanci\BankCard\Parser;

class ParserFactory
{
    /**
     * @param string $parserName
     * @param string $cardNumber
     *
     * @return mixed
     */
    public static function instance($parserName, $cardNumber)
    {
        $parserClassName = __NAMESPACE__.'\\'.ucfirst($parserName).'Parser';

        return new $parserClassName($cardNumber);
    }
}
