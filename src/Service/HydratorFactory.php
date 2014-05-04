<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Service;

use Sake\BlockchainWalletApi\Hydrator;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\Filter\FilterComposite;
use Zend\Stdlib\Hydrator\Filter\MethodMatchFilter;

/**
 * Hydrator factory
 *
 * Creates class methods hydrator with strategies and filter to hydratoe response/request data
 */
class HydratorFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $hydrator = new ClassMethods();

        // use special hydration for these methods
        $hydrator->addStrategy('addresses', new Hydrator\AddressStrategy());
        $hydrator->addStrategy('consolidated', new Hydrator\AddressListStrategy());

        // dont extract data of these functions
        $hydrator->addFilter(
            'method',
            new MethodMatchFilter("getMethod"),
            FilterComposite::CONDITION_AND
        );
        $hydrator->addFilter(
            'arguments',
            new MethodMatchFilter("getArguments"),
            FilterComposite::CONDITION_AND
        );
        return $hydrator;
    }
}
