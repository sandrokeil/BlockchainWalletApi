<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Validator;

use PHPUnit_Framework_TestCase as TestCase;
use Sake\BlockchainWalletApi\Validator\BitcoinAddress;
use Zend\Stdlib\ArrayUtils;

/**
 * Class BitcoinAddressTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Validator\BitcoinAddress
 */
class BitcoinAddressTest extends TestCase
{
    /**
     * Tests if getMethod returns the correct api method
     *
     * @dataProvider dataProviderForTestIsValid
     * @group validator
     *
     * @covers \Sake\BlockchainWalletApi\Validator\BitcoinAddress::isValid
     * @covers \Sake\BlockchainWalletApi\Validator\BitcoinAddress::decode
     * @covers \Sake\BlockchainWalletApi\Validator\BitcoinAddress::encodeHex
     */
    public function testIsValid($address, $expected)
    {
        $cut = new BitcoinAddress();

        if ('exception' === $expected) {
            $this->setExpectedException(
                '\Sake\BlockchainWalletApi\Validator\Exception\ValidatorException',
                'Could not decode bitcoin address'
            );
            $cut->isValid($address);
        } else {
            $this->assertEquals($expected, $cut->isValid($address));
        }
    }

    /**
     * data provider for the test method testIsValid()
     *
     * @return array
     */
    public function dataProviderForTestIsValid()
    {
        $validAddresses = json_decode(file_get_contents(__DIR__ . '/TestAsset/bitcoin_addresses_valid.json'));

        array_walk(
            $validAddresses,
            function (&$item) {
                $item['expected'] = true;
            }
        );

        $invalidAddresses = json_decode(file_get_contents(__DIR__ . '/TestAsset/bitcoin_addresses_invalid.json'));

        array_walk(
            $invalidAddresses,
            function (&$item) {
                $item['expected'] = false;
            }
        );

        $addresses = ArrayUtils::merge($validAddresses, $invalidAddresses, false);

        $exceptionAddresses = json_decode(file_get_contents(__DIR__ . '/TestAsset/bitcoin_addresses_exception.json'));

        array_walk(
            $exceptionAddresses,
            function (&$item) {
                $item['expected'] = 'exception';
            }
        );

        return ArrayUtils::merge($addresses, $exceptionAddresses, false);
    }
}
