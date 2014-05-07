<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Service\InputFilter;

use \Sake\BlockchainWalletApi\Service\InputFilter\SendManyFactory;
use SakeTest\BlockchainWalletApi\Service\AbstractFactoryTestCase as TestCase;

/**
 * Class SendManyFactoryTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Service\InputFilter\SendManyFactory
 */
class SendManyFactoryTest extends TestCase
{
    /**
     * Tests createService() returns a valid and configured input filter instance.
     *
     * @covers \Sake\BlockchainWalletApi\Service\InputFilter\SendManyFactory::createService
     * @group factory
     */
    public function testCreateService()
    {
        $cut = new SendManyFactory();

        /* @var $inputFilter \Zend\InputFilter\InputFilterInterface */
        $inputFilter = $cut->createService($this->serviceManager);

        $this->assertInstanceOf('\Zend\InputFilter\InputFilterInterface', $inputFilter);
        $this->assertTrue($inputFilter->has('recipients'));
        $this->assertTrue($inputFilter->has('from'));
        $this->assertTrue($inputFilter->has('fee'));
    }
}
