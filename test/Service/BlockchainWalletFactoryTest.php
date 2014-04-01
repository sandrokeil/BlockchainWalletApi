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

/**
 * Class BlockChainWalletFactoryTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Service\BlockchainWalletFactory
 */
class BlockchainWalletFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;

    /**
     * @var ModuleLoader
     */
    protected $moduleLoader;

    /**
     * Setup tests
     */
    public function setUp()
    {
        parent::setUp();

        // Load the user-defined test configuration file, if it exists; otherwise, load default
        if (is_readable('test/TestConfig.php')) {
            $testConfig = require 'test/TestConfig.php';
        } else {
            $testConfig = require 'test/TestConfig.php.dist';
        }
        $this->moduleLoader = new ModuleLoader($testConfig);
        $this->serviceManager = $this->moduleLoader->getServiceManager();
    }

    /**
     * Tests getServiceConfig() should should return service manager configuration
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
     * Tests getServiceConfig() should should return service manager configuration
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletFactory::createService
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

    /**
     * Returns stub of test object
     *
     * @param array $methods Methods for test doubles
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getStubForTest(array $methods = null)
    {
        $stub = $this->getMock('\Sake\BlockchainWalletApi\Service\BlockchainWalletFactory', $methods);
        $stub->expects($this->any())
            ->method('getClient')
            ->will($this->returnValue(new Http\Client(null, array('adapter' => new Http\Client\Adapter\Test()))));
        return $stub;
    }
}
