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
use Sake\BlockchainWalletApi\Request\Recipient;
use Sake\BlockchainWalletApi\Request\SendMany;

/**
 * Class SendManyTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Request\SendMany
 */
class SendManyTest extends TestCase
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
        $cut = new SendMany();
        $this->assertInstanceOf('\Sake\BlockchainWalletApi\Request\RequestInterface', $cut);
    }

    /**
     * Tests if getMethod returns the correct api method
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\SendMany::getMethod
     */
    public function testGetMethod()
    {
        $cut = new SendMany();
        $this->assertEquals('sendmany', $cut->getMethod());
    }

    /**
     * Tests if request can be configured via setter
     *
     * @group request
     *
     * @covers \Sake\BlockchainWalletApi\Request\SendMany::setRecipients
     * @covers \Sake\BlockchainWalletApi\Request\SendMany::getRecipients
     * @covers \Sake\BlockchainWalletApi\Request\SendMany::setFee
     * @covers \Sake\BlockchainWalletApi\Request\SendMany::getFee
     * @covers \Sake\BlockchainWalletApi\Request\SendMany::setFrom
     * @covers \Sake\BlockchainWalletApi\Request\SendMany::getFrom
     * @covers \Sake\BlockchainWalletApi\Request\SendMany::setNote
     * @covers \Sake\BlockchainWalletApi\Request\SendMany::getNote
     * @covers \Sake\BlockchainWalletApi\Request\SendMany::setShared
     * @covers \Sake\BlockchainWalletApi\Request\SendMany::getShared
     */
    public function testIfRequestDataCanBeSet()
    {
        $cut = new SendMany();

        $recipients = array(
            new Recipient('regl4jtwe8flmf23knfsd', 10000),
            new Recipient('23dskflsfuo2u4ourjsd', 20000),
            new Recipient('34tfskdlfcvkdjhvkjwehf', 30000),
        );

        $fee = '100';
        $from = '1Q1AtvCyKhtveGm3187mgNRh5YcukUWjQC';
        $note = 'test';
        $shared = 'true';

        $cut->setRecipients($recipients);
        $cut->setFee($fee);
        $cut->setFrom($from);
        $cut->setNote($note);
        $cut->setShared($shared);

        $this->assertEquals($recipients, $cut->getRecipients());
        $this->assertEquals((int) $fee, $cut->getFee());
        $this->assertEquals($from, $cut->getFrom());
        $this->assertEquals($note, $cut->getNote());
        $this->assertEquals((bool) $shared, $cut->getShared());
    }

    /**
     * Tests if getArguments returns request arguments
     *
     * @group request
     * @depends testIfRequestDataCanBeSet
     *
     * @covers \Sake\BlockchainWalletApi\Request\SendMany::getArguments
     */
    public function testGetArguments()
    {
        $recipients = array(
            new Recipient('regl4jtwe8flmf23knfsd', 10000),
            new Recipient('23dskflsfuo2u4ourjsd', 20000),
            new Recipient('34tfskdlfcvkdjhvkjwehf', 30000),
        );

        $data = array(
            'recipients' => json_encode(
                array(
                    'regl4jtwe8flmf23knfsd' => 10000,
                    '23dskflsfuo2u4ourjsd' => 20000,
                    '34tfskdlfcvkdjhvkjwehf' => 30000,
                )
            )
        );

        $cut = new SendMany();

        $cut->setRecipients($recipients);
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
