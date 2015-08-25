<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Hydrator;

use PHPUnit_Framework_TestCase as TestCase;
use Sake\BlockchainWalletApi\Hydrator\AddressStrategy;

/**
 * Class AddressStrategyTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Hydrator\AddressStrategy
 */
class AddressStrategyTest extends TestCase
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
        $cut = new AddressStrategy();
        $this->assertInstanceOf('\Zend\Stdlib\Hydrator\Strategy\StrategyInterface', $cut);
    }

    /**
     * Tests if extract() throws an exception
     *
     * @group hydrator
     *
     * @covers \Sake\BlockchainWalletApi\Hydrator\AddressStrategy::extract
     */
    public function testExtractShouldThrowException()
    {
        $cut = new AddressStrategy();

        $this->setExpectedException('\Sake\BlockchainWalletApi\Exception\RuntimeException', 'Extract is not supported');
        $cut->extract('test');
    }

    /**
     * Tests if hydrate() works as expected
     *
     * @group hydrator
     *
     * @covers \Sake\BlockchainWalletApi\Hydrator\AddressStrategy::hydrate
     * @covers \Sake\BlockchainWalletApi\Hydrator\AddressStrategy::getHydrator
     */
    public function testHydrate()
    {
        $cut = new AddressStrategy();

        $data = json_decode(
            '[
                {
                    "balance": 1400938800,
                    "address": "1Q1AtvCyKhtveGm3187mgNRh5YcukUWjQC",
                    "label": "SMS Deposits",
                    "total_received": 5954572400
                },
                {
                    "balance": 79434360,
                    "address": "1A8JiWcwvpY7tAopUkSnGuEYHmzGYfZPiq",
                    "label": "My Wallet",
                    "total_received": 453300048335
                },
                {
                    "balance": 0,
                    "address": "17p49XUC2fw4Fn53WjZqYAm4APKqhNPEkY",
                    "total_received": 0
                }
            ]',
            true
        );

        $this->assertEmpty($cut->hydrate(''));

        $current = $cut->hydrate($data);
        $this->assertCount(3, $current);

        foreach ($current as $address) {
            $this->assertInstanceOf('\Sake\BlockchainWalletApi\Response\Address', $address);
        }
    }
}
