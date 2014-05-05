<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Service;

use Sake\BlockchainWalletApi\Service\RequestPluginManager;
use Zend\Http;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Class RequestPluginManagerTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Service\RequestPluginManager
 */
class RequestPluginManagerTest extends TestCase
{
    /**
     * Tests validatePlugin() throws no exception for available request classes
     *
     * @dataProvider dataProviderForTestValidatePlugin
     *
     * @covers \Sake\BlockchainWalletApi\Service\RequestPluginManager::validatePlugin
     * @group service
     */
    public function testValidatePlugin($plugin, $expected)
    {
        $manager = new RequestPluginManager();

        $this->assertInstanceOf($expected, $manager->get($plugin));
    }

    /**
     * Tests validatePlugin() should throw runtime exception if request interface is missing
     *
     * @covers \Sake\BlockchainWalletApi\Service\RequestPluginManager::validatePlugin
     * @group service
     */
    public function testValidatePluginThrowsRuntimeExceptionIfInterfaceIsMissong()
    {
        $manager = new RequestPluginManager();

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
                'expected' => '\Sake\BlockchainWalletApi\Request\AddressArchive',
            ),
            array(
                'plugin' => 'address_balance',
                'expected' => '\Sake\BlockchainWalletApi\Request\AddressBalance',
            ),
            array(
                'plugin' => 'unarchive_address',
                'expected' => '\Sake\BlockchainWalletApi\Request\AddressUnarchive',
            ),
            array(
                'plugin' => 'auto_consolidate',
                'expected' => '\Sake\BlockchainWalletApi\Request\AutoConsolidateAddresses',
            ),
            array(
                'plugin' => 'list',
                'expected' => '\Sake\BlockchainWalletApi\Request\ListAddresses',
            ),
            array(
                'plugin' => 'new_address',
                'expected' => '\Sake\BlockchainWalletApi\Request\NewAddress',
            ),
            array(
                'plugin' => 'payment',
                'expected' => '\Sake\BlockchainWalletApi\Request\Send',
            ),
            array(
                'plugin' => 'sendmany',
                'expected' => '\Sake\BlockchainWalletApi\Request\SendMany',
            ),
            array(
                'plugin' => 'balance',
                'expected' => '\Sake\BlockchainWalletApi\Request\WalletBalance',
            ),
        );
    }
}
