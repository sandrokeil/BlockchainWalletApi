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
use Sake\BlockchainWalletApi\Response\AutoConsolidateAddresses;

/**
 * Class AutoConsolidateAddressesTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Response\AutoConsolidateAddresses
 */
class AutoConsolidateAddressesTest extends TestCase
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
        $cut = new AutoConsolidateAddresses();
        $this->assertInstanceOf('\Sake\BlockchainWalletApi\Response\ResponseInterface', $cut);
    }

    /**
     * Tests if response can be configured via setter
     *
     * @group response
     *
     * @covers \Sake\BlockchainWalletApi\Response\AutoConsolidateAddresses::setConsolidated
     * @covers \Sake\BlockchainWalletApi\Response\AutoConsolidateAddresses::getConsolidated
     */
    public function testIfResponseDataCanBeSet()
    {
        $cut = new AutoConsolidateAddresses();

        $addresses = array(
            '1A8JiWcwvpY7tAopUkSnGuEYHmzGYfZPiq',
            '34tfskdlfcvkdjhvkjwehf',
        );

        $cut->setConsolidated($addresses);

        $this->assertEquals($addresses, $cut->getConsolidated());
    }
}
