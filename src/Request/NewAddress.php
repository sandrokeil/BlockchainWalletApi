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
 * Request for new address method
 *
 * This class handles data for new address request
 */
class NewAddress implements RequestInterface
{
    /**
     * The minimum number of confirmations transactions must have before being included in balance of addresses
     *
     * @var string
     */
    protected $label;

    /**
     * Service method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'new_address';
    }

    /**
     * Returns arguments if set
     *
     * @return array Arguments
     */
    public function getArguments()
    {
        $args = array();

        if (null !== $this->label) {
            $args['label'] = $this->label;
        }
        return $args;
    }

    /**
     * Set label for address e.g. order number
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

}
