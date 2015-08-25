<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Response;

use PHPUnit_Framework_TestCase as TestCase;
use Sake\BlockchainWalletApi\Response\NewAddress;

/**
 * Class NewAddressTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Response\NewAddress
 */
class NewAddressTest extends TestCase
{
    /**
     * Tests if class implements response interface
     *
     * @group response
     *
     * @codeCoverageIgnore
     */
    public function testIsResponseClass()
    {
        $cut = new NewAddress();
        $this->assertInstanceOf('\Sake\BlockchainWalletApi\Response\ResponseInterface', $cut);
    }

    /**
     * Tests if response can be configured via setter
     *
     * @group response
     *
     * @covers \Sake\BlockchainWalletApi\Response\NewAddress::setLabel
     * @covers \Sake\BlockchainWalletApi\Response\NewAddress::getLabel
     * @covers \Sake\BlockchainWalletApi\Response\NewAddress::setAddress
     * @covers \Sake\BlockchainWalletApi\Response\NewAddress::getAddress
     */
    public function testIfResponseDataCanBeSet()
    {
        $cut = new NewAddress();

        $label = 'test wallet';
        $address = 'sf2lkdsf23987ancxsacj23sdsf';

        $cut->setLabel($label);
        $cut->setAddress($address);

        $this->assertEquals($label, $cut->getLabel());
        $this->assertEquals($address, $cut->getAddress());
    }
}
