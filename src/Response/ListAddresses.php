<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Response;

use Zend\Stdlib\ArrayObject;

/**
 * Response for list addresses request
 *
 * This class contains the result data of the list addresses request
 */
class ListAddresses extends ArrayObject implements ResponseInterface
{
    /**
     * Bitcoin addresses
     *
     * @var array
     */
    protected $addresses = array();

    /**
     * Sets addresses
     *
     * @param array $addresses List of address objects with bitcoin address as index
     */
    public function setAddresses(array $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * Returns addresses
     *
     * @return array List of address objects with bitcoin address as index
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
}
