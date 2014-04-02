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
use Sake\BlockchainWalletApi\Request\WalletBalance;

/**
 * Class WalletBalanceTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Request\WalletBalance
 */
class WalletBalanceTest extends TestCase
{
    /**
     * Tests if getMethod returns the correct api method
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\WalletBalance::getMethod
     */
    public function testGetMethod()
    {
        $cut = new WalletBalance();
        $this->assertEquals('balance', $cut->getMethod());
    }

    /**
     * Tests if getArguments returns request arguments
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\WalletBalance::getArguments
     */
    public function testGetArguments()
    {
        $cut = new WalletBalance();

        $this->assertEquals(array(), $cut->getArguments());
    }
}
