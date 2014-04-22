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
use Sake\BlockchainWalletApi\Response\AddressUnarchive;

/**
 * Class AddressUnarchiveTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Response\AddressUnarchive
 */
class AddressUnarchiveTest extends TestCase
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
        $cut = new AddressUnarchive();
        $this->assertInstanceOf('\Sake\BlockchainWalletApi\Response\ResponseInterface', $cut);
    }

    /**
     * Tests if response can be configured via setter
     *
     * @group response
     *
     * @covers \Sake\BlockchainWalletApi\Response\AddressUnarchive::setActive
     * @covers \Sake\BlockchainWalletApi\Response\AddressUnarchive::getActive
     */
    public function testIfResponseDataCanBeSet()
    {
        $cut = new AddressUnarchive();

        $address = 'sf2lkdsf23987ancxsacj23sdsf';

        $cut->setActive($address);

        $this->assertEquals($address, $cut->getActive());
    }
}
