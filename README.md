Ollama PHP Library
============
This is a PHP library for Ollama. Ollama is an open-source project that serves as a powerful and user-friendly platform for running LLMs on your local
machine. It acts as a bridge between the complexities of LLM technology and the desire for an accessible and
customizable AI experience.

> [!WARNING]  
> This library is not fully implemented yet. It is still under development. Please do not use it in production.

## Buy me a coffee

Whether you use this project, have learned something from it, or just like it, please consider supporting it by buying
me a coffee, so I can dedicate more time on open-source projects like this :)

<a href="https://www.buymeacoffee.com/ardagnsrn" target="_blank"><img src="https://www.buymeacoffee.com/assets/img/custom_images/orange_img.png" alt="Buy Me A Coffee" style="height: auto !important;width: auto !important;" ></a>

## Installation

You can install the package via composer:

```bash
composer require ardagnsrn/ollama-php
```

## Usage

```php
$skeleton = new ArdaGnsrn\Ollama();
echo $skeleton->echoPhrase('Hello, ArdaGnsrn!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Arda GUNSUREN](https://github.com/ArdaGnsrn)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
