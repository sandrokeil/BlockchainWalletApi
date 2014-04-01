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
 * Request interface
 *
 * Defines necessary methods to send a request to the wallet api
 */
interface RequestInterface
{
    /**
     * Return service method
     *
     * @return string
     */
    public function getMethod();

    /**
     * Return the arguments for the server's method. If the method does not require any arguments, return an empty
     * array!
     *
     * @return array Arguments
     */
    public function getArguments();
}
