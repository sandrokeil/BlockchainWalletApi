<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Response;

use PHPUnit_Framework_TestCase as TestCase;
use Sake\BlockchainWalletApi\Response\Address;

/**
 * Class AddressTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Response\Address
 */
class AddressTest extends TestCase
{
    /**
     * Tests if getMethod returns the correct api method
     *
     * @group response
     *
     * @covers \Sake\BlockchainWalletApi\Response\Address::getBalance
     * @covers \Sake\BlockchainWalletApi\Response\Address::setBalance
     * @covers \Sake\BlockchainWalletApi\Response\Address::setAddress
     * @covers \Sake\BlockchainWalletApi\Response\Address::getAddress
     * @covers \Sake\BlockchainWalletApi\Response\Address::setLabel
     * @covers \Sake\BlockchainWalletApi\Response\Address::getLabel
     * @covers \Sake\BlockchainWalletApi\Response\Address::setTotalReceived
     * @covers \Sake\BlockchainWalletApi\Response\Address::getTotalReceived
     */
    public function testDataCanBeSet()
    {
        $cut = new Address();

        $cut->setBalance('100000');
        $cut->setAddress('sdfwfjdsfg4wr23fecdsb');
        $cut->setLabel('test address');
        $cut->setTotalReceived('1000000');

        $this->assertEquals(100000, $cut->getBalance());
        $this->assertEquals('sdfwfjdsfg4wr23fecdsb', $cut->getAddress());
        $this->assertEquals('test address', $cut->getLabel());
        $this->assertEquals(1000000, $cut->getTotalReceived());
    }
}
