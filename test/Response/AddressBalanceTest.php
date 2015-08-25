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
use Sake\BlockchainWalletApi\Response\AddressBalance;

/**
 * Class AddressBalanceTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Response\AddressBalance
 */
class AddressBalanceTest extends TestCase
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
        $cut = new AddressBalance();
        $this->assertInstanceOf('\Sake\BlockchainWalletApi\Response\ResponseInterface', $cut);
    }

    /**
     * Tests if response can be configured via setter
     *
     * @dataProvider dataProviderForTestIfResponseDataCanBeSet
     * @group response
     *
     * @covers \Sake\BlockchainWalletApi\Response\AddressBalance::setAddress
     * @covers \Sake\BlockchainWalletApi\Response\AddressBalance::getAddress
     * @covers \Sake\BlockchainWalletApi\Response\AddressBalance::setBalance
     * @covers \Sake\BlockchainWalletApi\Response\AddressBalance::getBalance
     * @covers \Sake\BlockchainWalletApi\Response\AddressBalance::setTotalReceived
     * @covers \Sake\BlockchainWalletApi\Response\AddressBalance::getTotalReceived
     */
    public function testIfResponseDataCanBeSet(
        $address,
        $balance,
        $totalReceived,
        $expectedAddress,
        $expectedBalance,
        $expectedTotalReceived
    ) {
        $cut = new AddressBalance();

        $cut->setAddress($address);
        $cut->setBalance($balance);
        $cut->setTotalReceived($totalReceived);

        $this->assertEquals($expectedAddress, $cut->getAddress());
        $this->assertEquals($expectedBalance, $cut->getBalance());
        $this->assertEquals($expectedTotalReceived, $cut->getTotalReceived());
    }

    /**
     * data provider for the test method testIsValidWithValuesAndValidatorsShouldWorkAsAspected()
     *
     * @return array
     */
    public function dataProviderForTestIfResponseDataCanBeSet()
    {
        $address = 'alfweifonoj4o3fsjfdsfds';

        return array(
            array(
                'address' => $address,
                'balance' => 50000,
                'totalReceived' => 100000,
                'expectedAddress' => $address,
                'expectedBalance' => 50000,
                'expectedTotalReceived' => 100000,
            ),
            array(
                'address' => $address,
                'balance' => '20000',
                'totalReceived' => '90000',
                'expectedAddress' => $address,
                'expectedBalance' => 20000,
                'expectedTotalReceived' => 90000,
            ),
        );
    }
}
