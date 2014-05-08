<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Hydrator;

use Sake\BlockchainWalletApi\Exception\RuntimeException;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;

/**
 * Strategy for a list of addresses from request
 *
 * This strategy converts a list of addresses from response to an array
 */
class AddressListStrategy implements StrategyInterface
{
    /**
     * Converts the given value so that it can be extracted by the hydrator.
     *
     * @param mixed $value The original value.
     * @return mixed|void
     * @throws \Sake\BlockchainWalletApi\Exception\RuntimeException
     */
    public function extract($value)
    {
        throw new RuntimeException('Extract is not supported');
    }

    /**
     * Converts the given value (addresses) so that it can be hydrated by the hydrator.
     *
     * @param mixed $value The original value.
     * @return array List of Response\Address objects
     */
    public function hydrate($value)
    {
        if (!is_array($value)) {
            return array();
        }

        $addresses = array();

        foreach ($value as $address) {
            $addresses[] = $address;
        }
        return $addresses;
    }
}
