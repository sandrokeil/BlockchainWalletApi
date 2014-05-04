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
use Zend\InputFilter\InputFilterInterface;
use Zend\ServiceManager\AbstractPluginManager;

/**
 * Plugin manager implementation for input filter.
 *
 * Enforces that input filter retrieved are either callbacks or instances of InputFilterInterface. Additionally, it
 * registers a number of default input filter which matches the blockchain wallet api service request method name.
 */
class InputFilterPluginManager extends AbstractPluginManager
{
    /**
     * Default set of input filter, note the method name must be without underscore
     *
     * @var array
     */
    protected $factories = array(
        'addressbalance' => '\Sake\BlockchainWalletApi\Service\InputFilter\AddressBalanceFactory',
        'balance'        => '\Sake\BlockchainWalletApi\Service\InputFilter\WalletBalanceFactory',
        'list'           => '\Sake\BlockchainWalletApi\Service\InputFilter\ListAddressesFactory',
        'newaddress'     => '\Sake\BlockchainWalletApi\Service\InputFilter\NewAddressFactory',
        'payment'        => '\Sake\BlockchainWalletApi\Service\InputFilter\SendFactory',
        'sendmany'       => '\Sake\BlockchainWalletApi\Service\InputFilter\SendManyFactory',
        'archiveaddress' => '\Sake\BlockchainWalletApi\Service\InputFilter\AddressArchiveFactory',
        'unarchiveaddress' => '\Sake\BlockchainWalletApi\Service\InputFilter\AddressUnarchiveFactory',
        'autoconsolidate' => '\Sake\BlockchainWalletApi\Service\InputFilter\AutoConsolidateAddressesFactory',
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
     * Checks that the filter loaded is either a valid callback or an instance
     * of FilterInterface.
     *
     * @param  mixed $plugin
     * @return void
     * @throws Exception\RuntimeException if invalid
     */
    public function validatePlugin($plugin)
    {
        if ($plugin instanceof InputFilterInterface) {
            // we're okay
            return;
        }
        if (is_callable($plugin)) {
            // also okay
            return;
        }

        throw new Exception\RuntimeException(sprintf(
            'Plugin of type %s is invalid; must implement %s\InputFilterInterface or be callable',
            (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
            'Zend\InputFilter'
        ));
    }
}
