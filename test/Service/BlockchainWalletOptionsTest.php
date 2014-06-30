<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Service;

use Sake\BlockchainWalletApi\Service\BlockchainWalletOptions;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Class BlockChainWalletTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions
 */
class BlockchainWalletOptionsTest extends TestCase
{
    /**
     * Tests setGuid() and getGuid() should work as expected
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::setGuid
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::getGuid
     * @group service
     */
    public function testSetGuid()
    {
        $cut = new BlockchainWalletOptions();
        $value = '123123123';

        $cut->setGuid($value);

        $this->assertEquals($value, $cut->getGuid());
    }

    /**
     * Tests setHttpMethod() and getHttpMethod() should work as expected
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::setHttpMethod
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::getHttpMethod
     * @group service
     */
    public function testSetHttpMethod()
    {
        $cut = new BlockchainWalletOptions();
        $value = \Zend\Http\Request::METHOD_POST;

        $this->assertEquals(\Zend\Http\Request::METHOD_GET, $cut->getHttpMethod());

        $cut->setHttpMethod($value);

        $this->assertEquals($value, $cut->getHttpMethod());
    }

    /**
     * Tests setMainPassword() and getMainPassword() should work as expected
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::setMainPassword
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::getMainPassword
     * @group service
     */
    public function testSetMainPassword()
    {
        $cut = new BlockchainWalletOptions();
        $value = 'secure';

        $cut->setMainPassword($value);

        $this->assertEquals($value, $cut->getMainPassword());
    }

    /**
     * Tests setSecondPassword() and getSecondPassword() should work as expected
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::setSecondPassword
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::getSecondPassword
     * @group service
     */
    public function testSetSecondPassword()
    {
        $cut = new BlockchainWalletOptions();
        $value = 'secure second';

        $cut->setSecondPassword($value);

        $this->assertEquals($value, $cut->getSecondPassword());
    }

    /**
     * Tests setUrl() and getUrl() should work as expected
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::setUrl
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::getUrl
     * @group service
     */
    public function testSetUrl()
    {
        $cut = new BlockchainWalletOptions();
        $value = 'https://blockchain.info/de/merchant/';

        $cut->setUrl($value);

        $this->assertEquals($value, $cut->getUrl());
    }

    /**
     * Tests getResponsePluginManager() return default response plugin manager if no one provided
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::getResponsePluginManager
     * @group service
     */
    public function testGetResponsePluginManagerShouldReturnDefaultResponsePluginManager()
    {
        $cut = new BlockchainWalletOptions();

        $this->assertInstanceOf(
            '\Sake\BlockchainWalletApi\Service\ResponsePluginManager',
            $cut->getResponsePluginManager()
        );
    }

    /**
     * Tests getInputFilterPluginManager() return default input filter manager if no one provided
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::getInputFilterPluginManager
     * @group service
     */
    public function testGetInputFilterPluginManagerShouldReturnDefaultFilterPluginManager()
    {
        $cut = new BlockchainWalletOptions();

        $this->assertInstanceOf(
            '\Sake\BlockchainWalletApi\Service\InputFilterPluginManager',
            $cut->getInputFilterPluginManager()
        );
    }

    /**
     * Tests getHydrator() return class methods hydrator if no one provided
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::getHydrator
     * @group service
     */
    public function testGetHydratorShouldReturnDefaultClassMethods()
    {
        $cut = new BlockchainWalletOptions();

        $this->assertInstanceOf(
            '\Zend\Stdlib\Hydrator\ClassMethods',
            $cut->getHydrator()
        );
    }

    /**
     * Tests setHydrator()
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions::setHydrator
     * @group service
     */
    public function testsetHydrator()
    {
        $cut = new BlockchainWalletOptions();

        $cut->setHydrator(new \Zend\Stdlib\Hydrator\ObjectProperty());

        $this->assertInstanceOf(
            '\Zend\Stdlib\Hydrator\ObjectProperty',
            $cut->getHydrator()
        );
    }
}
