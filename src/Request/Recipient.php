<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Request;

/**
 * Model for recipient data for send many request
 *
 * This class contains the data of recipients for send many request
 */
class Recipient
{
    /**
     * Amount to send in satoshi
     *
     * @var int
     */
    protected $amount;

    /**
     * Bitcoin address
     *
     * @var string
     */
    protected $address;

    /**
     * Initialize object
     *
     * @param string $address
     * @param int $amount
     */
    public function __construct($address = null, $amount = null)
    {
        if (null !== $amount) {
            $this->setAmount($amount);
        }
        if (null !== $address) {
            $this->setAddress($address);
        }
    }

    /**
     * Sets bitcoin address
     *
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = (string) $address;
    }

    /**
     * Returns bitcoin address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Sets amount to send in satoshi
     *
     * @param int $balance
     */
    public function setAmount($balance)
    {
        $this->amount = (int) $balance;
    }

    /**
     * Returns amount to send  in satoshi
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }
}
