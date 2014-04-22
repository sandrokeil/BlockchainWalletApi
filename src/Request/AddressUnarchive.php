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
 * Request for unarchive address method
 *
 * This class handles data for unarchive address request
 */
class AddressUnarchive implements RequestInterface
{
    /**
     * Bitcoin address
     *
     * @var string
     */
    protected $address;

    /**
     * Service method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'unarchive_address';
    }

    /**
     * Return the arguments for the server's method. If the method does not require any arguments, return an empty
     * array!
     *
     * @return array Arguments
     */
    public function getArguments()
    {
        return array(
            'address' => $this->address,
        );
    }

    /**
     * Set bitcoin address to retrieve balance
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
}
