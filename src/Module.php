<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi;

/**
 * This class initializes the BlockchainWalletApi module.
 */
class Module
{
    /**
     * Return module config e.g. service manager, view helper
     *
     * @return array
     */
    public function getConfig()
    {
        return require dirname(__DIR__) . '/config/module.config.php';
    }
}
