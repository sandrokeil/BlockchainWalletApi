# Blockchain Wallet Api module for Zend Framework 2

[![Build Status](https://travis-ci.org/sandrokeil/BlockchainWalletApi.png?branch=master)](https://travis-ci.org/sandrokeil/BlockchainWalletApi)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sandrokeil/BlockchainWalletApi/badges/quality-score.png?s=e0089b63bdd99801480a5c7aedbda372767990ab)](https://scrutinizer-ci.com/g/sandrokeil/BlockchainWalletApi/)
[![Coverage Status](https://coveralls.io/repos/sandrokeil/BlockchainWalletApi/badge.png)](https://coveralls.io/r/sandrokeil/BlockchainWalletApi)
[![Latest Stable Version](https://poser.pugx.org/sandrokeil/blockchain-wallet-api/v/stable.png)](https://packagist.org/packages/sandrokeil/blockchain-wallet-api)
[![Dependency Status](https://www.versioneye.com/user/projects/53615c9cfe0d07b45c000082/badge.png)](https://www.versioneye.com/user/projects/53615c9cfe0d07b45c000082)
[![Total Downloads](https://poser.pugx.org/sandrokeil/blockchain-wallet-api/downloads.png)](https://packagist.org/packages/sandrokeil/blockchain-wallet-api)
[![License](https://poser.pugx.org/sandrokeil/blockchain-wallet-api/license.png)](https://packagist.org/packages/sandrokeil/blockchain-wallet-api)

Zend Framework 2 client library for [blockchain wallet api](https://blockchain.info/en/api/blockchain_wallet_api). The usage is simple. Configure request, call the service and access the response data via objects.

 * **Adapts To Your Needs.** There are several possibilities to configure this module.
 * **Well tested.** Besides unit test and continuous integration/inspection this solution is also ready for production use.
 * **Great foundations.** Based on [Zend Framework 2](https://github.com/zendframework/zf2) and [Easy Config](https://github.com/sandrokeil/EasyConfig)
 * **Every change is tracked**. Want to know whats new? Take a look at [CHANGELOG.md](https://github.com/sandrokeil/BlockchainWalletApi/blob/master/CHANGELOG.md)
 * **Listen to your ideas.** Have a great idea? Bring your tested pull request or open a new issue.

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

Please refer to [blockchain wallet api documentation](https://blockchain.info/en/api/blockchain_wallet_api) for request details.

These request classes matches to api methods

 * Send => payment
 * SendMany => sendmany
 * WalletBalance => balance
 * ListAddresses => list
 * AddressBalance => address_balance
 * NewAddress => new_address
 * AddressArchive => archive_address
 * AddressUnarchive => unarchive_address
 * AutoConsolidateAddresses => auto_consolidate

Here is an example how to send bitcoins to an bitcoin address:

```php
<?php

use Sake\BlockchainWalletApi;

// $sl is the service locator
$blockchain = $sl->get('sake_bwa.service.default');

$request = $sl->get('sake_bwa.service.request')->get('send');
// or
$request = new BlockchainWalletApi\Request\Send();

$request->setAmount(10000000); // in satoshi
$request->setTo('1A8JiWcwvpY7tAopUkSnGuEYHmzGYfZPiq');

try {
    // validate request
    if ($blockchain->isValid($request)) {
        /* @var $response BlockchainWalletApi\Response\Send */
        $response = $service->send($request);
        // access to response data
        $transactionHash = $response->getTxHash();
    }
} catch (BlockchainWalletApi\Exception\ExceptionInterface $exception) {
    // error handling
}
```

Here is an example how to retrieve wallet balance:

```php
<?php

use Sake\BlockchainWalletApi;

// $sl is the service locator
$blockchain = $sl->get('sake_bwa.service.default');

$request = $sl->get('sake_bwa.service.request')->get('balance');
// or
$request = new BlockchainWalletApi\Request\WalletBalance();


try {
    // validate request
    if ($blockchain->isValid($request)) {
        /* @var $response BlockchainWalletApi\Response\WalletBalance */
        $response = $blockchain->send($request);
        // access to response data
        $balance = $response->getBalance(); // in satoshi
    }
} catch (BlockchainWalletApi\Exception\ExceptionInterface $exception) {
    // error handling
}
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

## Registered service names
 * `sake_bwa.service.default`: a \Sake\BlockchainWalletApi\Service\BlockchainWallet instance to send requests to the api
 * `sake_bwa.service.response`: a \Sake\BlockchainWalletApi\Service\ResponsePluginManager Service plugin manager to create responses via api method name
 * `sake_bwa.service.request`: a \Sake\BlockchainWalletApi\Service\RequestPluginManager Service plugin manager to create requests via api method name
 * `sake_bwa.service.input_filter`: a \Sake\BlockchainWalletApi\Service\InputFilterPluginManager Service plugin manager to create input filter via api method name
 * `sake_bwa.service.hydrator`: a \Zend\Stdlib\Hydrator\ClassMethods instance with strategies and filters for requests/responses

## Todo's
 * More unit tests
 * Satoshi converter/filter
