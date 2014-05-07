<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Service\InputFilter;

use \Sake\BlockchainWalletApi\Service\InputFilter\ListAddressesFactory;
use SakeTest\BlockchainWalletApi\Service\AbstractFactoryTestCase as TestCase;

/**
 * Class ListAddressesTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Service\InputFilter\ListAddressesFactory
 */
class ListAddressesTest extends TestCase
{
    /**
     * Tests createService() returns a valid and configured input filter instance.
     *
     * @covers \Sake\BlockchainWalletApi\Service\InputFilter\ListAddressesFactory::createService
     * @group factory
     */
    public function testCreateService()
    {
        $cut = new ListAddressesFactory();

        /* @var $inputFilter \Zend\InputFilter\InputFilterInterface */
        $inputFilter = $cut->createService($this->serviceManager);

        $this->assertInstanceOf('\Zend\InputFilter\InputFilterInterface', $inputFilter);
        $this->assertTrue($inputFilter->has('confirmations'));
    }
}
