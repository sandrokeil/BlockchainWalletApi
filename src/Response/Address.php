<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Response;

/**
 * Model for address data of list address request
 *
 * This class contains the result data of the addresses from list address request
 */
class Address
{
    /**
     * Balance in satoshi
     *
     * @var int
     */
    protected $balance;

    /**
     * Bitcoin address
     *
     * @var string
     */
    protected $address;

    /**
     * Label
     *
     * @var string
     */
    protected $label;

    /**
     * Total received amount in satoshi
     *
     * @var int
     */
    protected $totalReceived;

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
     * Sets balance amount in satoshi
     *
     * @param int $balance
     */
    public function setBalance($balance)
    {
        $this->balance = (int) $balance;
    }

    /**
     * Returns balance amount in satoshi
     *
     * @return int
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * Sets label
     *
     * @param string $label
     */
    public function setLabel($label)
    {
        $this->label = (string) $label;
    }

    /**
     * Returns label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Sets total received amount in satoshi
     *
     * @param int $totalReceived
     */
    public function setTotalReceived($totalReceived)
    {
        $this->totalReceived = (int) $totalReceived;
    }

    /**
     * Returns total received amount in satoshi
     *
     * @return int
     */
    public function getTotalReceived()
    {
        return $this->totalReceived;
    }
}
