<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi\Service;

use Sake\BlockchainWalletApi\Request;
use Sake\BlockchainWalletApi\Response;
use Sake\BlockchainWalletApi\Service\BlockchainWalletOptions;
use Zend\Http;
use PHPUnit_Framework_TestCase as TestCase;

/**
 * Class BlockChainWalletTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Service\BlockchainWallet
 */
class BlockchainWalletTest extends TestCase
{
    /**
     * Tests send() with address balance request
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::send
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::__construct
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::extractData
     * @group service
     */
    public function testSendWithRequestAddressBalance()
    {
        $service = $this->getStubForTest(file_get_contents(__DIR__ . '/TestAsset/Response/address_balance.txt'));

        $request = new Request\AddressBalance();
        $request->setAddress('efjsdkfjkwefkwejfkesf');

        /* @var $response Response\AddressBalance */
        $response = $service->send($request);

        $expected = trim(file_get_contents(__DIR__ . '/TestAsset/Request/address_balance.txt'));
        // workaround for crlf line endings
        $actual = preg_replace('~\R~u', "\n", trim($service->getClient()->getLastRawRequest()));

        $this->assertEquals(
            $expected,
            $actual,
            $expected . PHP_EOL . ' does not match ' . PHP_EOL . $actual
        );
        $this->assertEquals(0, $response->getBalance());
    }

    /**
     * Tests send() with wallet balance request
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::send
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::__construct
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::extractData
     * @group service
     */
    public function testSendWithRequestWalletBalance()
    {
        $service = $this->getStubForTest(file_get_contents(__DIR__ . '/TestAsset/Response/wallet_balance.txt'));

        $request = new Request\WalletBalance();

        /* @var $response Response\WalletBalance */
        $response = $service->send($request);

        $expected = trim(file_get_contents(__DIR__ . '/TestAsset/Request/wallet_balance.txt'));
        // workaround for crlf line endings
        $actual = preg_replace('~\R~u', "\n", trim($service->getClient()->getLastRawRequest()));

        $this->assertEquals(
            $expected,
            $actual,
            $expected . PHP_EOL . ' does not match ' . PHP_EOL . $actual
        );

        $this->assertEquals(0, $response->getBalance());
    }

    /**
     * Tests send() with new address request
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::send
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::__construct
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::extractData
     * @group service
     */
    public function testSendWithRequestNewAddress()
    {
        $service = $this->getStubForTest(file_get_contents(__DIR__ . '/TestAsset/Response/new_address.txt'));

        $request = new Request\NewAddress();

        /* @var $response Response\NewAddress */
        $response = $service->send($request);

        $this->assertEquals('Order No : 1234', $response->getLabel());
        $this->assertEquals('18fyqiZzndTxdVo7g9ouRogB4uFj86JJiy', $response->getAddress());
    }

    /**
     * Tests send() with list addresses request
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::send
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::__construct
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::extractData
     * @group service
     */
    public function testSendWithRequestListAddresses()
    {
        $service = $this->getStubForTest(file_get_contents(__DIR__ . '/TestAsset/Response/list_addresses.txt'));

        $request = new Request\ListAddresses();

        /* @var $response Response\ListAddresses */
        $response = $service->send($request);

        $addresses = $response->getAddresses();

        $this->assertCount(3, $addresses);
        $this->assertArrayHasKey('1Q1AtvCyKhtveGm3187mgNRh5YcukUWjQC', $addresses);
        $this->assertArrayHasKey('1A8JiWcwvpY7tAopUkSnGuEYHmzGYfZPiq', $addresses);
        $this->assertArrayHasKey('17p49XUC2fw4Fn53WjZqYAm4APKqhNPEkY', $addresses);
        $this->assertInstanceOf('\Sake\BlockchainWalletApi\Response\Address', current($addresses));
    }

    /**
     * Tests send() with send request
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::send
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::__construct
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::extractData
     * @group service
     */
    public function testSendWithRequestSend()
    {
        $service = $this->getStubForTest(file_get_contents(__DIR__ . '/TestAsset/Response/send.txt'));

        $request = new Request\Send();

        $request->setAmount(10000000);
        $request->setTo('1A8JiWcwvpY7tAopUkSnGuEYHmzGYfZPiq');

        /* @var $response Response\Send */
        $response = $service->send($request);

        $this->assertEquals('Sent 0.1 BTC to 1A8JiWcwvpY7tAopUkSnGuEYHmzGYfZPiq', $response->getMessage());
        $this->assertEquals(
            'f322d01ad784e5deeb25464a5781c3b20971c1863679ca506e702e3e33c18e9c',
            $response->getTxHash()
        );
        $this->assertEquals(
            'Some funds are pending confirmation and cannot be spent yet (Value 0.001 BTC)',
            $response->getNotice()
        );
    }

    /**
     * Tests send() with send many request
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::send
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::__construct
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::extractData
     * @group service
     */
    public function testSendWithRequestSendMany()
    {
        $service = $this->getStubForTest(file_get_contents(__DIR__ . '/TestAsset/Response/send_many.txt'));

        $recipients = array(
            new Request\Recipient('regl4jtwe8flmf23knfsd', 10000),
            new Request\Recipient('23dskflsfuo2u4ourjsd', 20000),
            new Request\Recipient('34tfskdlfcvkdjhvkjwehf', 30000),
        );

        $request = new Request\SendMany();

        $request->setRecipients($recipients);

        /* @var $response Response\Send */
        $response = $service->send($request);

        $this->assertEquals('Sent To Multiple Recipients', $response->getMessage());
        $this->assertEquals(
            'f322d01ad784e5deeb25464a5781c3b20971c1863679ca506e702e3e33c18e9c',
            $response->getTxHash()
        );
    }

    /**
     * Tests send() with archive address request
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::send
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::__construct
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::extractData
     * @group service
     */
    public function testSendWithRequestAddressArchive()
    {
        $service = $this->getStubForTest(file_get_contents(__DIR__ . '/TestAsset/Response/address_archive.txt'));

        $request = new Request\AddressArchive();

        /* @var $response Response\AddressArchive */
        $response = $service->send($request);

        $this->assertEquals('18fyqiZzndTxdVo7g9ouRogB4uFj86JJiy', $response->getArchived());
    }

    /**
     * Tests send() with unarchive address request
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::send
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::__construct
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::extractData
     * @group service
     */
    public function testSendWithRequestAddressUnarchive()
    {
        $service = $this->getStubForTest(file_get_contents(__DIR__ . '/TestAsset/Response/address_unarchive.txt'));

        $request = new Request\AddressUnarchive();

        /* @var $response Response\AddressUnarchive */
        $response = $service->send($request);

        $this->assertEquals('18fyqiZzndTxdVo7g9ouRogB4uFj86JJiy', $response->getActive());
    }

    /**
     * Tests send() with auto consolidate addresses request
     *
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::send
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::__construct
     * @covers \Sake\BlockchainWalletApi\Service\BlockchainWallet::extractData
     * @group service
     */
    public function testSendWithRequestAutoConsolidateAddresses()
    {
        $service = $this->getStubForTest(
            file_get_contents(__DIR__ . '/TestAsset/Response/auto_consolidate_addresses.txt')
        );

        $request = new Request\AutoConsolidateAddresses();
        $request->setDays(10);

        /* @var $response Response\AutoConsolidateAddresses */
        $response = $service->send($request);

        $consolidated = array('18fyqiZzndTxdVo7g9ouRogB4uFj86JJiy', '1Q1AtvCyKhtveGm3187mgNRh5YcukUWjQC');

        $this->assertEquals($consolidated, $response->getConsolidated());
    }

    /**
     * Returns stub of test object
     *
     * @param string $response Http response
     * @param array $methods Methods for test doubles
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getStubForTest($response, array $methods = null)
    {
        $stub = $this->getMock(
            '\Sake\BlockchainWalletApi\Service\BlockchainWallet',
            $methods,
            array(
                new Http\Client(null, array('adapter' => new Http\Client\Adapter\Test())),
                new BlockchainWalletOptions(
                    array(
                        'url' => 'https://blockchain.info/de/merchant/',
                        'guid' => 'test43',
                        'main_password' => 'mainpwd',
                        'second_password' => 'secpwd',
                    )
                )
            )
        );
        $stub->getClient()->getAdapter()->setResponse($response);
        return $stub;
    }
}
