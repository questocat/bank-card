# bank-card

The bank card analysis library

## Installation

Using [Composer](https://getcomposer.org) to add the package to your project's dependencies:

```php
composer require emanci/bank-card
```

## Usage

```php
$bankCard = new BankCard('620043459807747768');
$bankCard->logo();   // output logo
$bankCard->info();   // output all info
```

## Reference
 - [支付宝合作银行](https://ab.alipay.com/i/yinhang.htm)

## License

Licensed under the [MIT license](https://github.com/emanci/bank-card/blob/master/LICENSE).
