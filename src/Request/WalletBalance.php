<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Request;

/**
 * Request for wallet balance method
 *
 * This class handles data for wallet balance request
 */
class WalletBalance implements RequestInterface
{
    /**
     * Service method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'balance';
    }

    /**
     * No arguments available
     *
     * @return array Arguments
     */
    public function getArguments()
    {
        return array();
    }
}
