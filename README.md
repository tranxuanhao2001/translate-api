[![Total Downloads](https://poser.pugx.org/haotx/translate-api/downloads)](https://packagist.org/packages/haotx/translate-api)

TranslateApi
==========

Translate 1.0.0 for PHP

This package is a wrapper of [Translate Yandex](https://tech.yandex.com/translate/doc/dg/concepts/About-docpage/) adapted to work with PHP.


Installation
============

```php
    composer require "haotx/translate-api:1.*"
```

Usage translate Yandex
============
[Get your api key of Yandex] (https://tech.yandex.com/keys/get/?service=trnsl)

Translate the text (Don't support translate multi text)
```php
use TranslateApi\Translate;
use TranslateApi\TranslateYandex;

$provider = new TranslateYandex($yourKeyApi);

$translate = new Translate($provider);
$result = $translate->translate('Hello world', 'en', 'vi');
```


Detect language the text
```php
use TranslateApi\Translate;
use TranslateApi\TranslateYandex;

$provider = new TranslateYandex($yourKeyApi);

$translate = new Translate($provider);
$result = $translate->detect('Hello world');
```

Get supported languages
```php
use TranslateApi\Translate;
use TranslateApi\TranslateYandex;

$provider = new TranslateYandex($yourKeyApi);

$translate = new Translate($provider);
$result = $translate->getSupportedLanguages(['ui' => 'en']);
```

Translate Yandex
======================
See more api of Yandex [look here](https://tech.yandex.com/translate/doc/dg/concepts/About-docpage/).
