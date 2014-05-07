<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Service;

use Zend\Http;
use Zend\Test\Util\ModuleLoader;
use SakeTest\BlockchainWalletApi\Service\AbstractFactoryTestCase as TestCase;

/**
 * Class BlockChainWalletFactoryTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Service\BlockchainWalletFactory
 */
class BlockchainWalletFactoryTestTestCase extends TestCase
{
    /**
     * Tests createService() returns a valid and configured service instance.
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletFactory::createService
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletFactory::__construct
     * @group factory
     */
    public function testCreateService()
    {
        $factory = $this->getMock('\Sake\BlockchainWalletApi\Service\BlockchainWalletFactory', array('getClient'));
        $factory->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue(new Http\Client(null, array('adapter' => new Http\Client\Adapter\Test()))));

        $config = $this->serviceManager->get('Config');
        $config = $config['sake_bwa']['connection']['default']['options'];

        /* @var $service \Sake\BlockchainWalletApi\Service\BlockchainWallet */
        $service = $factory->createService($this->serviceManager);
        $this->assertInstanceOf(
            '\Sake\BlockchainWalletApi\Service\BlockchainWallet',
            $service,
            'Factory could not create BlockchainWallet service instance'
        );
        // test options
        $this->assertSame($config['guid'], $service->getOptions()->getGuid(), 'guid not set in options class');
        $this->assertSame($config['url'], $service->getOptions()->getUrl(), 'url not set in options class');
        $this->assertSame(
            $config['main_password'],
            $service->getOptions()->getMainPassword(),
            'main password not set in options class'
        );
        $this->assertSame(
            $config['second_password'],
            $service->getOptions()->getSecondPassword(),
            'second password not set in options class'
        );
    }

    /**
     * Tests createService() throws runtime exception if no options are provided
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletFactory::createService
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletFactory::getModule
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletFactory::getScope
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletFactory::getName
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletFactory::__construct
     * @group factory
     */
    public function testCreateServiceThrowsRuntimeExceptionIfNoOptionsAvailable()
    {
        $stub = $this->getMock(
            '\Sake\BlockchainWalletApi\Service\BlockchainWalletFactory',
            array('getOptions', 'getClient')
        );

        $stub->expects($this->any())
            ->method('getOptions')
            ->will($this->returnValue(array('options' => array())));

        $this->setExpectedException(
            '\Sake\BlockchainWalletApi\Exception\RuntimeException',
            'No options defined'
        );

        $stub->createService($this->serviceManager);
    }
}
