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
 * Response for unarchive address request
 *
 * This class contains the result data of the unarchive address request
 */
class AddressUnarchive implements ResponseInterface
{
    /**
     * Unarchived address
     *
     * @var string
     */
    protected $active;

    /**
     * Sets unarchived address
     *
     * @param string $address
     */
    public function setActive($address)
    {
        $this->active = (string) $address;
    }

    /**
     * Returns unarchived address
     *
     * @return string
     */
    public function getActive()
    {
        return $this->active;
    }
}
