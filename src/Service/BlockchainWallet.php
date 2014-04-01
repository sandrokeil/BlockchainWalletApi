<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Service;

use Sake\BlockchainWalletApi\Request\RequestInterface;
use Sake\BlockchainWalletApi\Response\ResponseInterface;
use Zend\Http\Client;
use Zend\Http\Request as HttpRequest;
use Zend\Http\Request;
use Zend\Http\Response as HttpResponse;
use Sake\BlockchainWalletApi\Exception;

/**
 * Blockchain wallet api service
 *
 * This class handles the requests to the blockchain wallet api.
 */
class BlockchainWallet
{
    /**
     * Configured zend http client
     *
     * @var \Zend\Http\Client
     */
    protected $client;

    /**
     * @var BlockchainWalletOptions
     */
    protected $options;

    /**
     * Initialize object
     *
     * @param Client $client Configured zend http client
     * @param BlockchainWalletOptions $options Service options
     */
    public function __construct(Client $client, BlockchainWalletOptions $options)
    {
        $this->client = $client;
        $this->options = $options;
    }

    /**
     * Sends the request to the blockchain wallet api
     *
     * @param RequestInterface $request Request
     * @return \Sake\BlockchainWalletApi\Response\ResponseInterface
     */
    public function send(RequestInterface $request)
    {
        $httpRequest = new HttpRequest();
        $httpRequest->setMethod($this->options->getHttpMethod());
        $httpRequest->setUri($this->getUri($request));

        // handle request type
        if (Request::METHOD_POST === $httpRequest->getMethod()) {
            $httpRequest->getPost()->fromArray($this->getArguments($request));
        } else {
            $httpRequest->getQuery()->fromArray($this->getArguments($request));
        }
        $httResponse = $this->client->send($httpRequest);

        $response = $this->getOptions()->getResponsePluginManager()->get($request->getMethod());
        $this->extractData($httResponse, $response);
        return $response;
    }

    /**
     * Builds the service url for request
     *
     * @param RequestInterface $request
     * @return string
     */
    protected function getUri(RequestInterface $request)
    {
        return rtrim($this->options->getUrl(), '/') . '/' . $this->options->getGuid() . '/' . $request->getMethod();
    }

    /**
     * Builds the arguments for the request
     *
     * @param RequestInterface $request
     * @return array
     */
    protected function getArguments(RequestInterface $request)
    {
        $args = array();

        if ($this->options->getMainPassword()) {
            $args['password'] = $this->options->getMainPassword();
        }

        if ($this->options->getSecondPassword()) {
            $args['second_password'] = $this->options->getSecondPassword();
        }
        return array_merge($args, $request->getArguments());
    }

    /**
     * Sets the response data to object
     *
     * @param HttpResponse $httpResponse
     * @param ResponseInterface $response
     * @throws Exception\RuntimeException
     */
    protected function extractData(HttpResponse $httpResponse, ResponseInterface $response)
    {
        if (!$httpResponse->isSuccess()) {
            throw new Exception\RuntimeException(
                'Server responded with HTTP Status Code: ' . $httpResponse->getStatusCode()
            );
        }
        $data = json_decode($httpResponse->getBody(), true);

        if (empty($data)) {
            throw new Exception\RuntimeException('Received no data from blockchain wallet api service');
        }

        if (!empty($data['error'])) {
            throw new Exception\RuntimeException($data['error']);
        }
        $this->options->getHydrator()->hydrate($data, $response);
    }

    /**
     * Returns http client
     *
     * @return \Zend\Http\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Returns current options
     *
     * @return \Sake\BlockchainWalletApi\Service\BlockchainWalletOptions
     */
    public function getOptions()
    {
        return $this->options;
    }


}
