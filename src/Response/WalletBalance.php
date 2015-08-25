<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Response;

/**
 * Response for wallet balance request
 *
 * This class contains the result data of the wallet balance request
 */
class WalletBalance implements ResponseInterface
{
    /**
     * Balance value in satoshi
     *
     * @var int
     */
    protected $balance;

    /**
     * Sets balance in satoshi
     *
     * @param int $balance
     */
    public function setBalance($balance)
    {
        $this->balance = (int) $balance;
    }

    /**
     * Returns balance in satoshi
     *
     * @return int
     */
    public function getBalance()
    {
        return $this->balance;
    }
}
