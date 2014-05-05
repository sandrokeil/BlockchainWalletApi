<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Service\InputFilter;

use Zend\InputFilter\Factory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Input filter factory for address unarchive request
 *
 * Creates input filter for address unarchive request validation
 */
class AddressUnarchiveFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $factory = new Factory();
        $inputFilter = $factory->createInputFilter(array(
            'address' => array(
                'name'       => 'address',
                'required'   => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                        'break_chain_on_failure' => true,
                    ),
                    array(
                        'name' => '\Sake\BlockchainWalletApi\Validator\BitcoinAddress',
                    ),
                ),
            ),
        ));
        return $inputFilter;
    }
}
