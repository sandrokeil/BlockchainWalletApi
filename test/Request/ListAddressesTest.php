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
use Sake\BlockchainWalletApi\Request\ListAddresses;

/**
 * Class ListAddressesTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Request\ListAddresses
 */
class ListAddressesTest extends TestCase
{
    /**
     * Tests if getMethod returns the correct api method
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\ListAddresses::getMethod
     */
    public function testGetMethod()
    {
        $cut = new ListAddresses();
        $this->assertEquals('list', $cut->getMethod());
    }

    /**
     * Tests if request can be configured via setter
     *
     * @dataProvider dataProviderForTestIfRequestDataCanBeSet
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\ListAddresses::setConfirmations
     * @covers \Sake\BlockchainWalletApi\Request\ListAddresses::getConfirmations
     */
    public function testIfRequestDataCanBeSet($confirmations, $exptectedConfirmations)
    {
        $cut = new ListAddresses();

        $cut->setConfirmations($confirmations);

        $this->assertEquals($exptectedConfirmations, $cut->getConfirmations());
    }

    /**
     * Tests if getArguments returns request arguments
     *
     * @group request
     * @depends testIfRequestDataCanBeSet
     *
     * @covers \Sake\BlockchainWalletApi\Request\ListAddresses::getArguments
     */
    public function testGetArguments()
    {
        $cut = new ListAddresses();

        $confirmations = 4;

        $cut->setConfirmations($confirmations);

        $expected = array(
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
        return array(
            array(
                'confirmations' => 4,
                'expectedConfirmations' => 4,
            ),
            array(
                'confirmations' => '4',
                'expectedConfirmations' => 4,
            ),
            array(
                'confirmations' => null,
                'expectedConfirmations' => 0,
            ),
        );
    }
}
