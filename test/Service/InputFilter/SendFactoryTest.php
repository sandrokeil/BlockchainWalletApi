<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Service\InputFilter;

use \Sake\BlockchainWalletApi\Service\InputFilter\SendFactory;
use SakeTest\BlockchainWalletApi\Service\AbstractFactoryTestCase as TestCase;

/**
 * Class SendFactoryTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Service\InputFilter\SendFactory
 */
class SendFactoryTest extends TestCase
{
    /**
     * Tests createService() returns a valid and configured input filter instance.
     *
     * @covers \Sake\BlockchainWalletApi\Service\InputFilter\SendFactory::createService
     * @group factory
     */
    public function testCreateService()
    {
        $cut = new SendFactory();

        /* @var $inputFilter \Zend\InputFilter\InputFilterInterface */
        $inputFilter = $cut->createService($this->serviceManager);

        $this->assertInstanceOf('\Zend\InputFilter\InputFilterInterface', $inputFilter);
        $this->assertTrue($inputFilter->has('to'));
        $this->assertTrue($inputFilter->has('amount'));
        $this->assertTrue($inputFilter->has('from'));
        $this->assertTrue($inputFilter->has('fee'));
    }
}
