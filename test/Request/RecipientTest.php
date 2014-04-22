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
use Sake\BlockchainWalletApi\Request\Recipient;

/**
 * Class RecipientTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Request\Recipient
 */
class RecipientTest extends TestCase
{
    /**
     * Tests if data can be set/get
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\Recipient::setAddress
     * @covers \Sake\BlockchainWalletApi\Request\Recipient::getAddress
     * @covers \Sake\BlockchainWalletApi\Request\Recipient::setAmount
     * @covers \Sake\BlockchainWalletApi\Request\Recipient::getAmount
     */
    public function testDataCanBeSet()
    {
        $cut = new Recipient();

        $cut->setAddress('sdfwfjdsfg4wr23fecdsb');
        $cut->setAmount('100000');

        $this->assertEquals(100000, $cut->getAmount());
        $this->assertEquals('sdfwfjdsfg4wr23fecdsb', $cut->getAddress());
    }

    /**
     * Tests if data can be set via constructor
     *
     * @group request
     *
     * @depends testDataCanBeSet
     *
     * @covers \Sake\BlockchainWalletApi\Request\Recipient::__construct
     */
    public function testConstructor()
    {
        $cut = new Recipient();

        $this->assertNull($cut->getAmount());
        $this->assertNull($cut->getAddress());

        $cut = new Recipient('sdfwfjdsfg4wr23fecdsb', '100000');

        $this->assertEquals(100000, $cut->getAmount());
        $this->assertEquals('sdfwfjdsfg4wr23fecdsb', $cut->getAddress());
    }
}
