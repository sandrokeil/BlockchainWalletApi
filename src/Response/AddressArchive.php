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
 * Response for archive address request
 *
 * This class contains the result data of the archive address request
 */
class AddressArchive implements ResponseInterface
{
    /**
     * Archived address
     *
     * @var string
     */
    protected $archived;

    /**
     * Sets archived address
     *
     * @param string $address
     */
    public function setArchived($address)
    {
        $this->archived = (string) $address;
    }

    /**
     * Returns archived address
     *
     * @return string
     */
    public function getArchived()
    {
        return $this->archived;
    }
}
