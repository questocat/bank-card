# bank-card

The bank card parser library

## Installation

Using [Composer](https://getcomposer.org) to add the package to your project's dependencies:

```php
composer require emanci/bank-card
```

## Usage

```php
$bankCard = new BankCard('620043459807747768');

// 获取银行卡详细信息
$bankCard->info();

// 返回值
[
    'bank_name' => '福建海峡银行',     // 银行名称
    'short_code' => 'FJHXBC',        // 银行简码
    'card_type_name' => '储蓄卡',     // 银行卡类型
    'card_type' => 'DC',             // 银行卡类型代码
    'BIN' => '620043',               // 卡 BIN
    'length' => 19,                  // 银行卡号位数
    'validated' => true,             // 卡 BIN 验证情况
    'logo' => 'https://apimg.alipay.com/combo.png?d=cashier&t=FJHXBC',   // 银行 Logo
]

// 根据指定的银行简码，获取银行 Logo
$bankCard->logo('CCB');
```

## Reference
 - [支付宝合作银行](https://ab.alipay.com/i/yinhang.htm)

## License

Licensed under the [MIT license](https://github.com/emanci/bank-card/blob/master/LICENSE).
