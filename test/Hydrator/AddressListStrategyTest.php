<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Hydrator;

use PHPUnit_Framework_TestCase as TestCase;
use Sake\BlockchainWalletApi\Hydrator\AddressListStrategy;

/**
 * Class AddressListStrategyTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Hydrator\AddressListStrategy
 */
class AddressListStrategyTest extends TestCase
{
    /**
     * Tests if class implements strategy interface
     *
     * @group request
     *
     * @codeCoverageIgnore
     */
    public function testIsHydratorStrategyClass()
    {
        $cut = new AddressListStrategy();
        $this->assertInstanceOf('\Zend\Stdlib\Hydrator\Strategy\StrategyInterface', $cut);
    }

    /**
     * Tests if extract() throws an exception
     *
     * @group hydrator
     *
     * @covers \Sake\BlockchainWalletApi\Hydrator\AddressListStrategy::extract
     */
    public function testExtractShouldThrowException()
    {
        $cut = new AddressListStrategy();

        $this->setExpectedException('\Sake\BlockchainWalletApi\Exception\RuntimeException', 'Extract is not supported');
        $cut->extract('test');
    }

    /**
     * Tests if hydrate() works as expected
     *
     * @group hydrator
     *
     * @covers \Sake\BlockchainWalletApi\Hydrator\AddressListStrategy::hydrate
     */
    public function testHydrate()
    {
        $cut = new AddressListStrategy();

        $data = json_decode('["18fyqiZzndTxdVo7g9ouRogB4uFj86JJiy", "1Q1AtvCyKhtveGm3187mgNRh5YcukUWjQC"]', true);

        $this->assertEmpty($cut->hydrate(''));

        $current = $cut->hydrate($data);
        $this->assertCount(2, $current);

        $this->assertSame(array_values($data), $current);
    }
}
