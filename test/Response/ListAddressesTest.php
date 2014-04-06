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
use Sake\BlockchainWalletApi\Response\Address;
use Sake\BlockchainWalletApi\Response\ListAddresses;

/**
 * Class ListAddressesTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Response\ListAddresses
 */
class ListAddressesTest extends TestCase
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
        $cut = new ListAddresses();
        $this->assertInstanceOf('\Sake\BlockchainWalletApi\Response\ResponseInterface', $cut);
    }

    /**
     * Tests if response can be configured via setter
     *
     * @dataProvider dataProviderForTestIfResponseDataCanBeSet
     * @group response
     *
     * @covers \Sake\BlockchainWalletApi\Response\ListAddresses::setAddresses
     * @covers \Sake\BlockchainWalletApi\Response\ListAddresses::getAddresses
     */
    public function testIfResponseDataCanBeSet($addresses, $expectedAddresses)
    {
        $cut = new ListAddresses();

        $cut->setAddresses($addresses);

        $this->assertEquals($expectedAddresses, $cut->getAddresses());
    }

    /**
     * data provider for the test method testIsValidWithValuesAndValidatorsShouldWorkAsAspected()
     *
     * @return array
     */
    public function dataProviderForTestIfResponseDataCanBeSet()
    {
        $address = new Address();
        $address->setBalance(100000);
        $address->setAddress('sdfwfjdsfg4wr23fecdsb');
        $address->setLabel('test address');
        $address->setTotalReceived(1000000);

        $addresses = array(
            $address->getAddress() => $address
        );

        return array(
            array(
                'addresses' => $addresses,
                'expectedAddresses' => $addresses,
            ),
        );
    }
}
