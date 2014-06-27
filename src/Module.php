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
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;

/**
 * This class initializes the BlockchainWalletApi module.
 */
class Module implements ServiceProviderInterface, ViewHelperProviderInterface
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

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array
     */
    public function getViewHelperConfig()
    {
        return require dirname(__DIR__) . '/config/view_helper.config.php';
    }
}
