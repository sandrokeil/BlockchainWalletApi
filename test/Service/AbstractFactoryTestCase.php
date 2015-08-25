<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Service;

use Zend\ServiceManager\ServiceManager;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Class AbstractTestCaseFactoryTest
 *
 * Base class for factory tests which setups module loader and service manager
 */
abstract class AbstractFactoryTestCase extends TestCase
{
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    protected $serviceManager;

    /**
     * Setup tests
     */
    public function setUp()
    {
        parent::setUp();

        // Load the user-defined test configuration file, if it exists; otherwise, load default
        if (is_readable('test/TestConfig.php')) {
            $testConfig = require 'test/testing.config.php';
        } else {
            $testConfig = require 'test/testing.config.php.dist';
        }

        $config = require 'config/module.config.php';

        $this->serviceManager = new ServiceManager(
            new \Zend\ServiceManager\Config($config['service_manager'])
        );
        $this->serviceManager->setService('Configuration', $testConfig);
    }
}
