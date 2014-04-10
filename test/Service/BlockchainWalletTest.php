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
                new BlockchainWalletOptions()
            )
        );
        $stub->getClient()->getAdapter()->setResponse($response);
        return $stub;
    }
}
