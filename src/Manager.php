<?php

namespace Emanci\BankCard;

use Emanci\BankCard\Parser\ParserFactory;

class Manager
{
    use LuhnTrait;

    /**
     * @var string
     */
    protected $cardNumber;

    /**
     * @var array
     */
    protected $available = ['Alipay', 'DictFile'];

    /**
     * BankCardManager construct.
     *
     * @param string $cardNumber
     */
    public function __construct($cardNumber)
    {
        $this->cardNumber = $cardNumber;
    }

    /**
     * Get a new instance of the Parser.
     *
     * @param string $parser
     *
     * @return mixed
     */
    public function parser($parser = null)
    {
        $parser = $parser ?: 'alipay';

        return ParserFactory::instance($parser, $this->cardNumber);
    }

    /**
     * Returns the bankCard instance.
     *
     * @return BankCard|null
     */
    public function bankCard()
    {
        $bankCard = null;

        foreach ($this->available as $parserName) {
            $bankCard = $this->parser($parserName)->bankCard();
            if ($bankCard->getValidated()) {
                break;
            }
        }

        return $bankCard;
    }

    /**
     * Dynamically call the default parser instance.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     */
    public function __call($method, $args)
    {
        return call_user_func_array([$this->parser(), $method], $args);
    }
}
