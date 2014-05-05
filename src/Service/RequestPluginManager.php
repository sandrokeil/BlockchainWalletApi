<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Service;

use Sake\BlockchainWalletApi\Exception;
use Sake\BlockchainWalletApi\Request\RequestInterface;
use Zend\ServiceManager\AbstractPluginManager;

/**
 * Plugin manager implementation for requests.
 *
 * Enforces that requests retrieved are either callbacks or instances of RequestInterface. Additionally, it
 * registers a number of default requests which matches the blockchain wallet api service request method name.
 */
class RequestPluginManager extends AbstractPluginManager
{
    /**
     * Default set of requests, note the method name must be without underscore
     *
     * @var array
     */
    protected $invokableClasses = array(
        'addressbalance' => '\Sake\BlockchainWalletApi\Request\AddressBalance',
        'balance'        => '\Sake\BlockchainWalletApi\Request\WalletBalance',
        'list'           => '\Sake\BlockchainWalletApi\Request\ListAddresses',
        'newaddress'     => '\Sake\BlockchainWalletApi\Request\NewAddress',
        'payment'        => '\Sake\BlockchainWalletApi\Request\Send',
        'sendmany'       => '\Sake\BlockchainWalletApi\Request\SendMany',
        'archiveaddress' => '\Sake\BlockchainWalletApi\Request\AddressArchive',
        'unarchiveaddress' => '\Sake\BlockchainWalletApi\Request\AddressUnarchive',
        'autoconsolidate' => '\Sake\BlockchainWalletApi\Request\AutoConsolidateAddresses',
    );

    /**
     * Whether or not to share by default; default to false
     *
     * @var bool
     */
    protected $shareByDefault = false;

    /**
     * Validate the plugin
     *
     * Checks that the request loaded is either a valid callback or an instance of RequestInterface.
     *
     * @param  mixed $plugin
     * @return void
     * @throws Exception\RuntimeException if invalid
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof RequestInterface) {
            // we're okay
            return;
        }
        if (is_callable($plugin)) {
            // also okay
            return;
        }

        throw new Exception\RuntimeException(sprintf(
            'Plugin of type %s is invalid; must implement %s\RequestInterface or be callable',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}
