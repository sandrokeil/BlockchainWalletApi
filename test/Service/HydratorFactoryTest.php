<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/HydratorApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/HydratorApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Service;

use Sake\BlockchainWalletApi\Service\HydratorFactory;
use SakeTest\BlockchainWalletApi\Service\AbstractFactoryTestCase as TestCase;

/**
 * Class BlockChainWalletFactoryTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Service\HydratorFactory
 */
class HydratorFactoryTestTestCase extends TestCase
{
    /**
     * Tests createService() returns a valid and configured service instance.
     *
     * @covers \Sake\BlockchainWalletApi\Service\HydratorFactory::createService
     * @group factory
     */
    public function testCreateService()
    {
        $cut = new HydratorFactory();

        /* @var $hydrator \Zend\Stdlib\Hydrator\ClassMethods */
        $hydrator = $cut->createService($this->serviceManager);

        $this->assertInstanceOf('\Zend\Stdlib\Hydrator\ClassMethods', $hydrator);
        $this->assertTrue($hydrator->hasStrategy('addresses'));
        $this->assertTrue($hydrator->hasStrategy('consolidated'));
        $this->assertTrue($hydrator->hasFilter('method'));
        $this->assertTrue($hydrator->hasFilter('arguments'));
    }
}
