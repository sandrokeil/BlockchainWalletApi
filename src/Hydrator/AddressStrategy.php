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
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Strategy\StrategyInterface;
use \Sake\BlockchainWalletApi\Response;

/**
 * Strategy for list addresses request
 *
 * This strategy creates for each address an address object with given address data
 */
class AddressStrategy implements StrategyInterface
{
    /**
     * Hydrator to set data to object
     *
     * @var ClassMethods
     */
    protected $hydrator;

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

        foreach ($value as $data) {
            $addresses[$data['address']] = new Response\Address();
            $this->getHydrator()->hydrate($data, $addresses[$data['address']]);

        }
        return $addresses;
    }

    /**
     * Returns hydrator
     *
     * @return ClassMethods
     */
    protected function getHydrator()
    {
        if (null === $this->hydrator) {
            $this->hydrator = new ClassMethods();
        }
        return $this->hydrator;
    }
}
