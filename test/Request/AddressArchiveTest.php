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
use Sake\BlockchainWalletApi\Request\AddressArchive;

/**
 * Class AddressArchiveTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Request\AddressArchive
 */
class AddressArchiveTest extends TestCase
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
        $cut = new AddressArchive();
        $this->assertInstanceOf('\Sake\BlockchainWalletApi\Request\RequestInterface', $cut);
    }

    /**
     * Tests if getMethod returns the correct api method
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\AddressArchive::getMethod
     */
    public function testGetMethod()
    {
        $cut = new AddressArchive();
        $this->assertEquals('archive_address', $cut->getMethod());
    }

    /**
     * Tests if request can be configured via setter
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\AddressArchive::setAddress
     * @covers \Sake\BlockchainWalletApi\Request\AddressArchive::getAddress
     */
    public function testIfRequestDataCanBeSet()
    {
        $cut = new AddressArchive();

        $address = '18fyqiZzndTxdVo7g9ouRogB4uFj86JJiy';

        $cut->setAddress($address);

        $this->assertEquals($address, $cut->getAddress());
    }

    /**
     * Tests if getArguments returns request arguments
     *
     * @group request
     * @depends testIfRequestDataCanBeSet
     *
     * @covers \Sake\BlockchainWalletApi\Request\AddressArchive::getArguments
     */
    public function testGetArguments()
    {
        $cut = new AddressArchive();

        $address = '18fyqiZzndTxdVo7g9ouRogB4uFj86JJiy';

        $cut->setAddress($address);

        $this->assertEquals(array('address' => $address), $cut->getArguments());
    }
}
