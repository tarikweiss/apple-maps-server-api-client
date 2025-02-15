# Apple Maps Server API Client

## Introduction

A PHP-based reference-implementation for the [Apple Maps Server API](https://developer.apple.com/documentation/applemapsserverapi). It uses tweaks like mapping some types as enums, to bring comfort for using this library.
This library supports version 1.2+ of Apple Maps Server API.

## Prerequisites

- PHP 8.1+
- OpenSSL module installed and enabled
- PSR18 + PSR17 compatible http client

## Installation

```shell
composer install tarikweiss/apple-maps-server-api-client
```

## Usage

### Fast-Forward ⏩️

I have fulfilled all prerequisites, just show me the bare usage!

```php

// This type of token source is for generated keys from the developer account.
$token = new \AppleMapsServerApiClient\Auth\InterimTokenSource('eyJra...')

// THis type of token source is for generating own auth token with private key.
$token = new \AppleMapsServerApiClient\Auth\PrivateKeyTokenSource(
    'JIHGFEDCBA',
    'ABCDEFGHIJ',
    file_get_contents('/file/to/private/key') // Alternatively you may use an OpenSSLAsymmetricKey object for example if you use a passphrase for your key.
);

$optionalPsr18ClientInstance = new \GuzzleHttp\Client();
$optionalPsr17RequestFactoryInstance = new \GuzzleHttp\Psr7\HttpFactory();

$client = new \AppleMapsServerApiClient\AppleMapsClient($token, $optionalPsr18ClientInstance, $optionalPsr17RequestFactoryInstance);

$geocodeQuery = new \AppleMapsServerApiClient\Query\GeocodeQuery('Markt Leipzig');
$geocodeQuery->lang = new \AppleMapsServerApiClient\Dto\Common\Lang('de-DE');

$placeResults = $client->geocode($geocodeQuery);
print_r($placeResults);
```

### Show me everything

#### Key obtaining

To use this client you have to obtain either a [Maps ID and a private key](https://developer.apple.com/documentation/applemapsserverapi/creating-a-maps-identifier-and-a-private-key) first.

Alternatively you may obtain a generated [token](https://developer.apple.com/documentation/MapKitJS/creating-a-maps-token), which is valid for 7 days, to experiment with the client. 
This should be used for development purposes only!

```php
// Use of private key with identifier
$token = new \AppleMapsServerApiClient\Auth\PrivateKeyTokenSource(
    'JIHGFEDCBA',
    'ABCDEFGHIJ',
    file_get_contents('/file/to/private/key')
);
```

```php
// Use of pre generated token
$token = new \AppleMapsServerApiClient\Auth\InterimTokenSource('eyJra...')
```

#### Usage of the client

```php
$optionalPsr18ClientInstance = new \GuzzleHttp\Client();
$optionalPsr17RequestFactoryInstance = new \GuzzleHttp\Psr7\HttpFactory();

$client = new \AppleMapsServerApiClient\AppleMapsClient($token, $optionalPsr18ClientInstance, $optionalPsr17RequestFactoryInstance);

$geocodeQuery = new \AppleMapsServerApiClient\Query\GeocodeQuery('Markt Leipzig');
$geocodeQuery->lang = new \AppleMapsServerApiClient\Dto\Common\Lang('de-DE');

$placeResults = $client->geocode($geocodeQuery);

print_r($placeResults);
```

#### HTTP Client

This library is using the `php/http-discovery` package to discover a default PSR18 + PSR17 compatible http client, if
no client is given. You can explicitly set the client instance, as well as the request factory instance.

For more information, please take a look into the [php-http-discovery docs](https://docs.php-http.org/en/latest/discovery.html).

## Resources

- [Developer Documentation Homepage](https://developer.apple.com/documentation/applemapsserverapi) of Apple Maps Server API
- [Create a Maps ID and a private key](https://developer.apple.com/documentation/applemapsserverapi/creating-a-maps-identifier-and-a-private-key) for production use
- [Create a pre generated token](https://developer.apple.com/documentation/MapKitJS/creating-a-maps-token) for development purposes
- [Configure http-discovery](https://docs.php-http.org/en/latest/discovery.html) to use a specific default http client

## Contribution

> Please have a look into the [Code of Conduct](CODE_OF_CONDUCT.md) before contributing.

- For filing bugs and features please use create an issue
- For fixing bugs or adding features feel free to create a pull-request.

### Docker

You may use docker to get a right-configured `php` instance. There is also a `Makefile` for some handy commands, 
like updating `composer` dependencies, executing tests and making a static analysis.

You need `docker` with `compose` as plugin.

## License

This project is licensed unter [MIT](LICENSE.md) license.