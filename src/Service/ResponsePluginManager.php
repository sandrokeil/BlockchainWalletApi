<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 - 2015 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Service;

use Sake\BlockchainWalletApi\Exception;
use Sake\BlockchainWalletApi\Response\ResponseInterface;
use Zend\ServiceManager\AbstractPluginManager;

/**
 * Plugin manager implementation for responses.
 *
 * Enforces that responses retrieved are either callbacks or instances of ResponseInterface. Additionally, it
 * registers a number of default responses which matches the blockchain wallet api service request method name.
 */
class ResponsePluginManager extends AbstractPluginManager
{
    /**
     * Default set of responses, note the method name must be without underscore
     *
     * @var array
     */
    protected $invokableClasses = array(
        'addressbalance' => '\Sake\BlockchainWalletApi\Response\AddressBalance',
        'balance'        => '\Sake\BlockchainWalletApi\Response\WalletBalance',
        'list'           => '\Sake\BlockchainWalletApi\Response\ListAddresses',
        'newaddress'     => '\Sake\BlockchainWalletApi\Response\NewAddress',
        'payment'        => '\Sake\BlockchainWalletApi\Response\Send',
        'sendmany'       => '\Sake\BlockchainWalletApi\Response\SendMany',
        'archiveaddress' => '\Sake\BlockchainWalletApi\Response\AddressArchive',
        'unarchiveaddress' => '\Sake\BlockchainWalletApi\Response\AddressUnarchive',
        'autoconsolidate' => '\Sake\BlockchainWalletApi\Response\AutoConsolidateAddresses',
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
     * Checks that the response loaded is either a valid callback or an instance of ResponseInterface.
     *
     * @param  mixed $plugin
     * @return void
     * @throws Exception\RuntimeException if invalid
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof ResponseInterface) {
            // we're okay
            return;
        }
        if (is_callable($plugin)) {
            // also okay
            return;
        }

        throw new Exception\RuntimeException(sprintf(
            'Plugin of type %s is invalid; must implement %s\ResponseInterface or be callable',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            __NAMESPACE__
        ));
    }
}
