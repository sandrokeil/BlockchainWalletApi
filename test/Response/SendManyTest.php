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
use Sake\BlockchainWalletApi\Response\SendMany;

/**
 * Class SendManyTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Response\SendMany
 */
class SendManyTest extends TestCase
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
        $cut = new SendMany();
        $this->assertInstanceOf('\Sake\BlockchainWalletApi\Response\ResponseInterface', $cut);
    }

    /**
     * Tests if response can be configured via setter
     *
     * @group response
     *
     * @covers \Sake\BlockchainWalletApi\Response\SendMany::setMessage
     * @covers \Sake\BlockchainWalletApi\Response\SendMany::getMessage
     * @covers \Sake\BlockchainWalletApi\Response\SendMany::setTxHash
     * @covers \Sake\BlockchainWalletApi\Response\SendMany::getTxHash
     */
    public function testIfResponseDataCanBeSet()
    {
        $cut = new SendMany();

        $message = 'test wallet';
        $txHash = 'sf2lkdsf235jfghj2sd996746987ancxsacj23sdsf';

        $cut->setMessage($message);
        $cut->setTxHash($txHash);

        $this->assertEquals($message, $cut->getMessage());
        $this->assertEquals($txHash, $cut->getTxHash());
    }
}
