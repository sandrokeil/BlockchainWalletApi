<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Request;

use PHPUnit_Framework_TestCase as TestCase;
use Sake\BlockchainWalletApi\Request\AutoConsolidateAddresses;

/**
 * Class AutoConsolidateAddressesTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Request\AutoConsolidateAddresses
 */
class AutoConsolidateAddressesTest extends TestCase
{
    /**
     * Tests if class implements request interface
     *
     * @group request
     *
     * @codeCoverageIgnore
     */
    public function testIsRequestClass()
    {
        $cut = new AutoConsolidateAddresses();
        $this->assertInstanceOf('\Sake\BlockchainWalletApi\Request\RequestInterface', $cut);
    }

    /**
     * Tests if getMethod returns the correct api method
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\AutoConsolidateAddresses::getMethod
     */
    public function testGetMethod()
    {
        $cut = new AutoConsolidateAddresses();
        $this->assertEquals('auto_consolidate', $cut->getMethod());
    }

    /**
     * Tests if request can be configured via setter
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\AutoConsolidateAddresses::setDays
     * @covers \Sake\BlockchainWalletApi\Request\AutoConsolidateAddresses::getDays
     */
    public function testIfRequestDataCanBeSet()
    {
        $cut = new AutoConsolidateAddresses();

        $days = '10';

        $cut->setDays($days);

        $this->assertEquals((int) $days, $cut->getDays());
    }

    /**
     * Tests if getArguments returns request arguments
     *
     * @group request
     * @depends testIfRequestDataCanBeSet
     *
     * @covers \Sake\BlockchainWalletApi\Request\AutoConsolidateAddresses::getArguments
     */
    public function testGetArguments()
    {
        $cut = new AutoConsolidateAddresses();

        $days = 10;

        $cut->setDays($days);

        $this->assertEquals(array('days' => $days), $cut->getArguments());
    }
}
