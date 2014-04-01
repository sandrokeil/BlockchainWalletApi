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
 * Request for list addresses method
 *
 * This class handles data for list addresses request
 */
class ListAddresses implements RequestInterface
{
    /**
     * The minimum number of confirmations transactions must have before being included in balance of addresses
     *
     * @var int
     */
    protected $confirmations;

    /**
     * Service method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'list';
    }

    /**
     * No arguments available
     *
     * @return array Arguments
     */
    public function getArguments()
    {
        $args = array();

        if (null !== $this->confirmations) {
            $args['confirmations'] = $this->confirmations;
        }
        return $args;
    }

    /**
     * The minimum number of confirmations transactions must have before being included in balance of
     * addresses (Optional)
     *
     * @param int $confirmations
     */
    public function setConfirmations($confirmations)
    {
        $this->confirmations = (int) $confirmations;
    }

    /**
     * Returns minimum number of confirmations
     *
     * @return int
     */
    public function getConfirmations()
    {
        return $this->confirmations;
    }
}
