<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Service\InputFilter;

use Zend\InputFilter\Factory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Input filter factory for send many request
 *
 * Creates input filter for send many request validation
 */
class SendManyFactory implements FactoryInterface
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
            'recipients' => array(
                'name'       => 'recipients',
                'required'   => true,
                'validators' => array(
                    array(
                        'name' => 'not_empty',
                    ),
                ),
            ),
            'from' => array(
                'name'       => 'from',
                'required'   => false,
                'validators' => array(
                    array(
                        'name' => '\Sake\BlockchainWalletApi\Validator\BitcoinAddress',
                    ),
                ),
            ),
            'fee' => array(
                'name'       => 'fee',
                'required'   => false,
                'validators' => array(
                    array(
                        'name' => 'greater_than',
                        'options' => array(
                            'min' => 1000, // satoshi
                        )
                    ),
                ),
            ),
        ));
        return $inputFilter;
    }
}
