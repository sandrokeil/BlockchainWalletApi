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
use Sake\BlockchainWalletApi\Request\NewAddress;

/**
 * Class NewAddressTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Request\NewAddress
 */
class NewAddressTest extends TestCase
{
    /**
     * Tests if getMethod returns the correct api method
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\NewAddress::getMethod
     */
    public function testGetMethod()
    {
        $cut = new NewAddress();
        $this->assertEquals('new_address', $cut->getMethod());
    }

    /**
     * Tests if request can be configured via setter
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\NewAddress::setLabel
     * @covers \Sake\BlockchainWalletApi\Request\NewAddress::getLabel
     */
    public function testIfRequestDataCanBeSet()
    {
        $cut = new NewAddress();

        $label = 'test wallet';

        $cut->setLabel($label);

        $this->assertEquals($label, $cut->getLabel());
    }

    /**
     * Tests if getArguments returns request arguments
     *
     * @group request
     * @depends testIfRequestDataCanBeSet
     *
     * @covers \Sake\BlockchainWalletApi\Request\NewAddress::getArguments
     */
    public function testGetArguments()
    {
        $cut = new NewAddress();

        $this->assertEquals(array(), $cut->getArguments());

        $label = 'test wallet';

        $cut->setLabel($label);

        $this->assertEquals(array('label' => $label), $cut->getArguments());
    }
}
