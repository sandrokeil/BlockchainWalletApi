<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

return array(
    'factories' => array(
        'sake_bwa.service.default' => '\Sake\BlockchainWalletApi\Service\BlockchainWalletFactory',
        'sake_bwa.service.hydrator' => '\Sake\BlockchainWalletApi\Service\HydratorFactory',
    ),
    'invokables' => array(
        'sake_bwa.service.request' => '\Sake\BlockchainWalletApi\Service\RequestPluginManager',
        'sake_bwa.service.response' => '\Sake\BlockchainWalletApi\Service\ResponsePluginManager',
        'sake_bwa.service.input_filter' => '\Sake\BlockchainWalletApi\Service\InputFilterPluginManager',
    ),
);
