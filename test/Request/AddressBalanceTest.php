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
use Sake\BlockchainWalletApi\Request\AddressBalance;

/**
 * Class AddressBalanceTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Request\AddressBalance
 */
class AddressBalanceTest extends TestCase
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
        $cut = new AddressBalance();
        $this->assertInstanceOf('\Sake\BlockchainWalletApi\Request\RequestInterface', $cut);
    }

    /**
     * Tests if getMethod returns the correct api method
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\AddressBalance::getMethod
     */
    public function testGetMethod()
    {
        $cut = new AddressBalance();
        $this->assertEquals('address_balance', $cut->getMethod());
    }

    /**
     * Tests if request can be configured via setter
     *
     * @dataProvider dataProviderForTestIfRequestDataCanBeSet
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\AddressBalance::setAddress
     * @covers \Sake\BlockchainWalletApi\Request\AddressBalance::getAddress
     * @covers \Sake\BlockchainWalletApi\Request\AddressBalance::setConfirmations
     * @covers \Sake\BlockchainWalletApi\Request\AddressBalance::getConfirmations
     */
    public function testIfRequestDataCanBeSet($address, $confirmations, $expectedAddress, $exptectedConfirmations)
    {
        $cut = new AddressBalance();

        $cut->setAddress($address);
        $cut->setConfirmations($confirmations);

        $this->assertEquals($expectedAddress, $cut->getAddress());
        $this->assertEquals($exptectedConfirmations, $cut->getConfirmations());
    }

    /**
     * Tests if getArguments returns request arguments
     *
     * @group request
     * @depends testIfRequestDataCanBeSet
     *
     * @covers \Sake\BlockchainWalletApi\Request\AddressBalance::getArguments
     */
    public function testGetArguments()
    {
        $cut = new AddressBalance();

        $address = 'fdgkl34grg34jlsdfjldsasdsad';
        $confirmations = 4;

        $cut->setAddress($address);
        $cut->setConfirmations($confirmations);

        $expected = array(
            'address' => $address,
            'confirmations' => $confirmations
        );

        $this->assertEquals($expected, $cut->getArguments());
    }

    /**
     * data provider for the test method testIsValidWithValuesAndValidatorsShouldWorkAsAspected()
     *
     * @return array
     */
    public function dataProviderForTestIfRequestDataCanBeSet()
    {
        $address = 'alfweifonoj4o3fsjfdsfds';

        return array(
            array(
                'address' => $address,
                'confirmations' => 4,
                'expectedAddress' => $address,
                'expectedConfirmations' => 4,
            ),
            array(
                'address' => $address,
                'confirmations' => '4',
                'expectedAddress' => $address,
                'expectedConfirmations' => 4,
            ),
            array(
                'address' => $address,
                'confirmations' => null,
                'expectedAddress' => $address,
                'expectedConfirmations' => 0,
            ),
        );
    }
}
