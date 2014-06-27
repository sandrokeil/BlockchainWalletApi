<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\View\Helper;

use PHPUnit_Framework_TestCase as TestCase;
use Sake\BlockchainWalletApi\View\Helper\Satoshi;

/**
 * Class SatoshiTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\View\Helper\Satoshi
 */
class SatoshiTest extends TestCase
{
    /**
     * Tests if __invoke returns bitcoin value set by defaultUnit
     *
     * @dataProvider dataProviderForInvokeFormatBitcoin
     * @group view
     *
     * @covers \Sake\BlockchainWalletApi\View\Helper\Satoshi::__invoke
     * @covers \Sake\BlockchainWalletApi\View\Helper\Satoshi::format
     * @covers \Sake\BlockchainWalletApi\View\Helper\Satoshi::setDefaultUnit
     */
    public function testInvokeWithSetDefaultUnit($satoshi, $expected)
    {
        $cut = new Satoshi($satoshi);
        $cut->setDefaultUnit(Satoshi::UNIT_BTC);
        $this->assertEquals($expected, $cut($satoshi));
    }

    /**
     * Tests if __invoke returns bitcoin value if no format is set
     *
     * @dataProvider dataProviderForInvokeFormatBitcoin
     * @group view
     *
     * @covers \Sake\BlockchainWalletApi\View\Helper\Satoshi::__invoke
     * @covers \Sake\BlockchainWalletApi\View\Helper\Satoshi::format
     */
    public function testInvokeShouldReturnBitcoin($satoshi, $expected)
    {
        $cut = new Satoshi($satoshi);
        $this->assertEquals($expected, $cut($satoshi));
    }

    /**
     * Tests if __invoke returns bitcoin value
     *
     * @dataProvider dataProviderForInvokeFormatBitcoin
     * @group view
     *
     * @covers \Sake\BlockchainWalletApi\View\Helper\Satoshi::__invoke
     * @covers \Sake\BlockchainWalletApi\View\Helper\Satoshi::format
     */
    public function testInvokeFormatBitcoin($satoshi, $expected)
    {
        $cut = new Satoshi($satoshi);
        $this->assertEquals($expected, $cut($satoshi, Satoshi::UNIT_BTC));
    }

    /**
     * Tests if __invoke returns milli bitcoin value
     *
     * @dataProvider dataProviderForInvokeFormatMilliBitcoin
     * @group view
     *
     * @covers \Sake\BlockchainWalletApi\View\Helper\Satoshi::__invoke
     * @covers \Sake\BlockchainWalletApi\View\Helper\Satoshi::format
     */
    public function testInvokeFormatMilliBitcoin($satoshi, $expected)
    {
        $cut = new Satoshi($satoshi);
        $this->assertEquals($expected, $cut($satoshi, Satoshi::UNIT_MBTC));
    }

    /**
     * Tests if __invoke returns micro bitcoin value
     *
     * @dataProvider dataProviderForInvokeFormatMicroBitcoin
     * @group view
     *
     * @covers \Sake\BlockchainWalletApi\View\Helper\Satoshi::__invoke
     * @covers \Sake\BlockchainWalletApi\View\Helper\Satoshi::format
     */
    public function testInvokeFormatMicroBitcoin($satoshi, $expected)
    {
        $cut = new Satoshi($satoshi);
        $this->assertEquals($expected, $cut($satoshi, Satoshi::UNIT_UBTC));
    }

    /**
     * data provider for the test method testInvokeFormatBitcoin()
     *
     * @return array
     */
    public function dataProviderForInvokeFormatBitcoin()
    {
        return array(
            array(
                'satoshi' => 100000000,
                'expected' => 1,
            ),
            array(
                'satoshi' => 1500000000,
                'expected' => 15,
            ),
            array(
                'satoshi' => 200000000,
                'expected' => 2,
            ),
            array(
                'satoshi' => 1,
                'expected' => 0.00000001,
            ),
            array(
                'satoshi' => 0,
                'expected' => 0,
            ),
            array(
                'satoshi' => 45000000,
                'expected' => 0.45,
            ),
        );
    }

    /**
     * data provider for the test method testInvokeFormatMilliBitcoin()
     *
     * @return array
     */
    public function dataProviderForInvokeFormatMilliBitcoin()
    {
        return array(
            array(
                'satoshi' => 100000000,
                'expected' => 1000,
            ),
            array(
                'satoshi' => 1500000000,
                'expected' =>15000,
            ),
            array(
                'satoshi' => 200000000,
                'expected' => 2000,
            ),
            array(
                'satoshi' => 1,
                'expected' => 0.00001,
            ),
            array(
                'satoshi' => 0,
                'expected' => 0,
            ),
        );
    }

    /**
     * data provider for the test method testInvokeFormatMicroBitcoin()
     *
     * @return array
     */
    public function dataProviderForInvokeFormatMicroBitcoin()
    {
        return array(
            array(
                'satoshi' => 100000000,
                'expected' => 1000000,
            ),
            array(
                'satoshi' => 1500000000,
                'expected' => 15000000,
            ),
            array(
                'satoshi' => 200000000,
                'expected' => 2000000,
            ),
            array(
                'satoshi' => 1,
                'expected' => 0.01,
            ),
            array(
                'satoshi' => 0,
                'expected' => 0,
            ),
        );
    }
}
