<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Service;

use Sake\BlockchainWalletApi\Service\ResponsePluginManager;
use Zend\Http;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Class ResponsePluginManagerTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Service\ResponsePluginManager
 */
class ResponsePluginManagerTest extends TestCase
{
    /**
     * Tests validatePlugin() should throw runtime exception if response interface is missing
     *
     * @covers \Sake\BlockchainWalletApi\Service\ResponsePluginManager::validatePlugin
     * @group service
     */
    public function testValidatePluginThrowsRuntimeExceptionIfInterfaceIsMissong()
    {
        $manager = new ResponsePluginManager();

        $this->setExpectedException('\Sake\BlockchainWalletApi\Exception\RuntimeException', 'Plugin of type');
        $manager->validatePlugin(new \stdClass());
    }

    /**
     * Tests validatePlugin() throws no exception for available response classes
     *
     * @dataProvider dataProviderForTestValidatePlugin
     *
     * @covers \Sake\BlockchainWalletApi\Service\ResponsePluginManager::validatePlugin
     * @group service
     */
    public function testValidatePlugin($plugin, $expected)
    {
        $manager = new ResponsePluginManager();

        $this->assertInstanceOf($expected, $manager->get($plugin));
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
                'expected' => '\Sake\BlockchainWalletApi\Response\AddressArchive',
            ),
            array(
                'plugin' => 'address_balance',
                'expected' => '\Sake\BlockchainWalletApi\Response\AddressBalance',
            ),
            array(
                'plugin' => 'unarchive_address',
                'expected' => '\Sake\BlockchainWalletApi\Response\AddressUnarchive',
            ),
            array(
                'plugin' => 'auto_consolidate',
                'expected' => '\Sake\BlockchainWalletApi\Response\AutoConsolidateAddresses',
            ),
            array(
                'plugin' => 'list',
                'expected' => '\Sake\BlockchainWalletApi\Response\ListAddresses',
            ),
            array(
                'plugin' => 'new_address',
                'expected' => '\Sake\BlockchainWalletApi\Response\NewAddress',
            ),
            array(
                'plugin' => 'payment',
                'expected' => '\Sake\BlockchainWalletApi\Response\Send',
            ),
            array(
                'plugin' => 'sendmany',
                'expected' => '\Sake\BlockchainWalletApi\Response\SendMany',
            ),
            array(
                'plugin' => 'balance',
                'expected' => '\Sake\BlockchainWalletApi\Response\WalletBalance',
            ),
        );
    }
}
