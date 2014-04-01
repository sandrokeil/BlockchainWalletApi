# Blockchain Wallet Api module for Zend Framework 2

[![Build Status](https://travis-ci.org/sandrokeil/BlockchainWalletApi.png?branch=master)](https://travis-ci.org/sandrokeil/BlockchainWalletApi)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sandrokeil/BlockchainWalletApi/badges/quality-score.png?s=e0089b63bdd99801480a5c7aedbda372767990ab)](https://scrutinizer-ci.com/g/sandrokeil/BlockchainWalletApi/)
[![Coverage Status](https://coveralls.io/repos/sandrokeil/BlockchainWalletApi/badge.png)](https://coveralls.io/r/sandrokeil/BlockchainWalletApi)
[![Latest Stable Version](https://poser.pugx.org/sandrokeil/blockchain-wallet-api/v/stable.png)](https://packagist.org/packages/sandrokeil/blockchain-wallet-api)
[![Dependency Status](https://www.versioneye.com/user/projects/533b24ce7bae4bcd2e000089/badge.png)](https://www.versioneye.com/user/projects/533b24ce7bae4bcd2e000089)
[![Total Downloads](https://poser.pugx.org/sandrokeil/blockchain-wallet-api/downloads.png)](https://packagist.org/packages/sandrokeil/blockchain-wallet-api)

This Zend Framework 2 module is a wrapper for the [blockchain wallet api](https://blockchain.info/en/api/blockchain_wallet_api). The usage is simple. Configure your request, call the service and access the response data via objects.

## Installation

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

Put the following into your composer.json

    {
        "require": {
            "sandrokeil/blockchain-wallet-api": "dev-master"
        }
    }

Then add `Sake\BlockchainWalletApi` to your `./config/application.config.php`.

Copy `config/blockchainwalletapi.local.php.dist` to `config/blockchainwalletapi.local.php` and configure the credentials. **Never commit this file to public repositories!**

## Documentation

Please refer to the [blockchain wallet api documentation](https://blockchain.info/en/api/blockchain_wallet_api) for request details.

These request classes matches to api methods

 * WalletBalance => balance
 * ListAddresses => list
 * AddressBalance => address_balance
 * NewAddress => new_address

Here is an example how to use if you want to get the wallet balance

```php
<?php

use Sake\BlockchainWalletApi;

// $sl is the service locator
$blockchain = $sl->get('sake_bwa.service.default');

$request = new BlockchainWalletApi\Request\WalletBalance();

/* @var $response BlockchainWalletApi\Response\WalletBalance */
$response = $blockchain->send($request);
$balance = $response->getBalance(); // in satoshi
```

## Configuration
Connection parameters can be defined in the application configuration:

```php
<?php

return array(
    'sake_bwa' => array(
        'connection' => array(
            'default' => array(
                'options' => array(
                    // see \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions for all configurations
                    'url' => 'https://blockchain.info/de/merchant/', // note on your country
                    'guid' => 'your My Wallet identifier (found on the login page)',
                    'main_password' => 'Your Main My wallet password',
                    'second_password' => 'Your second My Wallet password if double encryption is enabled',
                ),
                'client' => 'Service factory name for Http Client, Lazy-loads a Zend\Http\Client instance if none registered'
            )
        )
    )
);
```

## Registered Service names
 * `sake_bwa.service.default`: a \Sake\BlockchainWalletApi\Service\BlockchainWallet instance to send requests to the api

## Todo's

 * Implement missing blockchain wallet api methods
 * Data validation, especially requests
 * More unit tests
 * Satoshi converter/filter
