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
use Sake\BlockchainWalletApi\Response\Send;

/**
 * Class SendTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Response\Send
 */
class SendTest extends TestCase
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
        $cut = new Send();
        $this->assertInstanceOf('\Sake\BlockchainWalletApi\Response\ResponseInterface', $cut);
    }

    /**
     * Tests if response can be configured via setter
     *
     * @group response
     *
     * @covers \Sake\BlockchainWalletApi\Response\Send::setMessage
     * @covers \Sake\BlockchainWalletApi\Response\Send::getMessage
     * @covers \Sake\BlockchainWalletApi\Response\Send::setTxHash
     * @covers \Sake\BlockchainWalletApi\Response\Send::getTxHash
     * @covers \Sake\BlockchainWalletApi\Response\Send::setNotice
     * @covers \Sake\BlockchainWalletApi\Response\Send::getNotice
     */
    public function testIfResponseDataCanBeSet()
    {
        $cut = new Send();

        $message = 'test wallet';
        $notice = 'message';
        $txHash = 'sf2lkdsf235jfghj2sd996746987ancxsacj23sdsf';

        $cut->setMessage($message);
        $cut->setTxHash($txHash);
        $cut->setNotice($notice);

        $this->assertEquals($message, $cut->getMessage());
        $this->assertEquals($txHash, $cut->getTxHash());
        $this->assertEquals($notice, $cut->getNotice());
    }
}
