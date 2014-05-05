<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Service;

use Sake\BlockchainWalletApi\Service\InputFilterPluginManager;
use Zend\Http;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Class InputFilterPluginManagerTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Service\InputFilterPluginManager
 */
class InputFilterPluginManagerTest extends TestCase
{
    /**
     * Tests validatePlugin() throws no exception for available input filter classes
     *
     * @dataProvider dataProviderForTestValidatePlugin
     *
     * @covers \Sake\BlockchainWalletApi\Service\InputFilterPluginManager::validatePlugin
     * @group service
     */
    public function testValidatePlugin($plugin, $expected)
    {
        $manager = new InputFilterPluginManager();

        $this->assertInstanceOf($expected, $manager->get($plugin));
    }

    /**
     * Tests validatePlugin() should throw runtime exception if input filter interface is missing
     *
     * @covers \Sake\BlockchainWalletApi\Service\InputFilterPluginManager::validatePlugin
     * @group service
     */
    public function testValidatePluginThrowsRuntimeExceptionIfInterfaceIsMissong()
    {
        $manager = new InputFilterPluginManager();

        $this->setExpectedException('\Sake\BlockchainWalletApi\Exception\RuntimeException', 'Plugin of type');
        $manager->validatePlugin(new \stdClass());
    }

    /**
     * data provider for the test method testValidatePlugin()
     *
     * @return array
     */
    public function dataProviderForTestValidatePlugin()
    {
        return array(
            array(
                'plugin' => 'archive_address',
                'expected' => '\Zend\InputFilter\InputFilterInterface',
            ),
            array(
                'plugin' => 'address_balance',
                'expected' => '\Zend\InputFilter\InputFilterInterface',
            ),
            array(
                'plugin' => 'unarchive_address',
                'expected' => '\Zend\InputFilter\InputFilterInterface',
            ),
            array(
                'plugin' => 'auto_consolidate',
                'expected' => '\Zend\InputFilter\InputFilterInterface',
            ),
            array(
                'plugin' => 'list',
                'expected' => '\Zend\InputFilter\InputFilterInterface',
            ),
            array(
                'plugin' => 'new_address',
                'expected' => '\Zend\InputFilter\InputFilterInterface',
            ),
            array(
                'plugin' => 'payment',
                'expected' => '\Zend\InputFilter\InputFilterInterface',
            ),
            array(
                'plugin' => 'sendmany',
                'expected' => '\Zend\InputFilter\InputFilterInterface',
            ),
            array(
                'plugin' => 'balance',
                'expected' => '\Zend\InputFilter\InputFilterInterface',
            ),
        );
    }
}
