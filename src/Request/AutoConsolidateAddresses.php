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
 * Request for auto_consolidate method
 *
 * This class handles data for archive address request
 */
class AutoConsolidateAddresses implements RequestInterface
{
    /**
     * Addresses which have not received any transactions in at least this many days will be consolidated
     *
     * @var int
     */
    protected $days;

    /**
     * Service method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'auto_consolidate';
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
            'days' => $this->days,
        );
    }

    /**
     * Set number of days.
     *
     * @param int $days
     */
    public function setDays($days)
    {
        $this->days = (int) $days;
    }

    /**
     * Returns number of days
     *
     * @return int
     */
    public function getDays()
    {
        return $this->days;
    }
}
