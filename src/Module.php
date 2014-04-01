<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi;

use Zend\ModuleManager\Feature\ServiceProviderInterface;

/**
 * This class initializes the BlockchainWalletApi module.
 */
class Module implements ServiceProviderInterface
{
    /**
     * Return service config
     *
     * @see ServiceProviderInterface::getServiceConfig()
     * @return array
     */
    public function getServiceConfig()
    {
        return require dirname(__DIR__) . '/config/service_manager.config.php';
    }
}
