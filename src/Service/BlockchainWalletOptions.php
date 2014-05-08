<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Service;

use Zend\Http\Request;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\AbstractOptions;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Stdlib\Hydrator\HydratorInterface;

/**
 * Blockchain wallet api service options
 *
 * Contains configuration for the blockchain wallet api service e.g. passwords.
 */
class BlockchainWalletOptions extends AbstractOptions
{
    /**
     * Service url
     *
     * @var string
     */
    protected $url;

    /**
     * Request method
     *
     * @var string
     */
    protected $httpMethod = Request::METHOD_GET;

    /**
     * Wallet identifier
     *
     * @var string
     */
    protected $guid;

    /**
     * Main password
     *
     * @var string
     */
    protected $mainPassword;

    /**
     * Second password
     *
     * @var string
     */
    protected $secondPassword;

    /**
     * Hydrator class
     *
     * @var HydratorInterface
     */
    protected $hydrator;

    /**
     * Plugin manager to create responses
     *
     * @var ResponsePluginManager
     */
    protected $responsePluginManager;

    /**
     * Plugin manager to create input filter
     *
     * @var InputFilterPluginManager
     */
    protected $inputFilterPluginManager;

    /**
     * Sets wallet identifier
     *
     * @param string $guid
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;
    }

    /**
     * Returns wallet identifier
     *
     * @return string
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * Sets http method
     *
     * @param string $httpMethod
     */
    public function setHttpMethod($httpMethod)
    {
        $this->httpMethod = $httpMethod;
    }

    /**
     * Returns http method
     *
     * @return string
     */
    public function getHttpMethod()
    {
        return $this->httpMethod;
    }

    /**
     * Sets main password
     *
     * @param string $mainPassword
     */
    public function setMainPassword($mainPassword)
    {
        $this->mainPassword = $mainPassword;
    }

    /**
     * Returns main password
     *
     * @return string
     */
    public function getMainPassword()
    {
        return $this->mainPassword;
    }

    /**
     * Sets second password
     *
     * @param string $secondPassword
     */
    public function setSecondPassword($secondPassword)
    {
        $this->secondPassword = $secondPassword;
    }

    /**
     * Returns second password
     *
     * @return string
     */
    public function getSecondPassword()
    {
        return $this->secondPassword;
    }

    /**
     * Sets service url e.g. https://blockchain.info/de/merchant
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Returns service url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets hydrator for hydration of result data to responses
     *
     * @param \Zend\Stdlib\Hydrator\HydratorInterface $hydrator
     */
    public function setHydrator(HydratorInterface $hydrator)
    {
        $this->hydrator = $hydrator;
    }

    /**
     * Returns hydrator for hydration of result data to responses. Lazy-loads a default class methods hydrator instance
     * if none registered
     *
     * @return \Zend\Stdlib\Hydrator\HydratorInterface
     */
    public function getHydrator()
    {
        if (null === $this->hydrator) {
            $this->hydrator = new ClassMethods();
        }
        return $this->hydrator;
    }

    /**
     * Returns response plugin manager. Lazy-loads a default response manager instance if none registered
     *
     * @return ServiceLocatorInterface
     */
    public function getResponsePluginManager()
    {
        if (null === $this->responsePluginManager) {
            $this->responsePluginManager = new ResponsePluginManager();
        }
        return $this->responsePluginManager;
    }

    /**
     * Service locator to retrieve response classes depending on request method
     *
     * @param ServiceLocatorInterface $responsePluginManager
     */
    public function setResponsePluginManager(ServiceLocatorInterface $responsePluginManager)
    {
        $this->responsePluginManager = $responsePluginManager;
    }

    /**
     * Returns input filter plugin manager. Lazy-loads a default input filter manager instance if none registered
     *
     * @return ServiceLocatorInterface
     */
    public function getInputFilterPluginManager()
    {
        if (null === $this->inputFilterPluginManager) {
            $this->inputFilterPluginManager = new InputFilterPluginManager();
        }
        return $this->inputFilterPluginManager;
    }

    /**
     * Service locator to retrieve input filter classes depending on request method
     *
     * @param ServiceLocatorInterface $inputFilterPluginManager
     */
    public function setInputFilterPluginManager(ServiceLocatorInterface $inputFilterPluginManager)
    {
        $this->inputFilterPluginManager = $inputFilterPluginManager;
    }
}
