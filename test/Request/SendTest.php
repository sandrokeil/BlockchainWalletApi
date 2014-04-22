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
use Sake\BlockchainWalletApi\Request\Send;

/**
 * Class SendTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Request\Send
 */
class SendTest extends TestCase
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
        $cut = new Send();
        $this->assertInstanceOf('\Sake\BlockchainWalletApi\Request\RequestInterface', $cut);
    }

    /**
     * Tests if getMethod returns the correct api method
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\Send::getMethod
     */
    public function testGetMethod()
    {
        $cut = new Send();
        $this->assertEquals('payment', $cut->getMethod());
    }

    /**
     * Tests if request can be configured via setter
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\Send::setAmount
     * @covers \Sake\BlockchainWalletApi\Request\Send::getAmount
     * @covers \Sake\BlockchainWalletApi\Request\Send::setFee
     * @covers \Sake\BlockchainWalletApi\Request\Send::getFee
     * @covers \Sake\BlockchainWalletApi\Request\Send::setFrom
     * @covers \Sake\BlockchainWalletApi\Request\Send::getFrom
     * @covers \Sake\BlockchainWalletApi\Request\Send::setNote
     * @covers \Sake\BlockchainWalletApi\Request\Send::getNote
     * @covers \Sake\BlockchainWalletApi\Request\Send::setShared
     * @covers \Sake\BlockchainWalletApi\Request\Send::getShared
     * @covers \Sake\BlockchainWalletApi\Request\Send::setTo
     * @covers \Sake\BlockchainWalletApi\Request\Send::getTo
     */
    public function testIfRequestDataCanBeSet()
    {
        $cut = new Send();

        $amount = '10000';
        $fee = '100';
        $from = '1Q1AtvCyKhtveGm3187mgNRh5YcukUWjQC';
        $note = 'test';
        $shared = 'true';
        $to = '1A8JiWcwvpY7tAopUkSnGuEYHmzGYfZPiq';

        $cut->setAmount($amount);
        $cut->setFee($fee);
        $cut->setFrom($from);
        $cut->setNote($note);
        $cut->setShared($shared);
        $cut->setTo($to);

        $this->assertEquals((int) $amount, $cut->getAmount());
        $this->assertEquals((int) $fee, $cut->getFee());
        $this->assertEquals($from, $cut->getFrom());
        $this->assertEquals($note, $cut->getNote());
        $this->assertEquals((bool) $shared, $cut->getShared());
        $this->assertEquals($to, $cut->getTo());
    }

    /**
     * Tests if getArguments returns request arguments
     *
     * @group request
     * @depends testIfRequestDataCanBeSet
     *
     * @covers \Sake\BlockchainWalletApi\Request\Send::getArguments
     */
    public function testGetArguments()
    {
        $data = array(
            'to' => '1A8JiWcwvpY7tAopUkSnGuEYHmzGYfZPiq',
            'amount' => 100000,
        );

        $cut = new Send();

        $cut->setTo($data['to']);
        $cut->setAmount($data['amount']);
        $this->assertEquals($data, $cut->getArguments());

        $data['from'] = '1Q1AtvCyKhtveGm3187mgNRh5YcukUWjQC';
        $cut->setFrom($data['from']);
        $this->assertEquals($data, $cut->getArguments());

        $data['shared'] = false;
        $cut->setShared($data['shared']);
        $this->assertEquals($data, $cut->getArguments());

        $data['fee'] = '100';
        $cut->setFee($data['fee']);
        $this->assertEquals($data, $cut->getArguments());

        $data['note'] = 'test';
        $cut->setNote($data['note']);
        $this->assertEquals($data, $cut->getArguments());
    }
}
