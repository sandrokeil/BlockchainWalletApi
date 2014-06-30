<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Service;

use Sake\BlockchainWalletApi\Exception\RuntimeException;
use Sake\EasyConfig\Service\AbstractConfigurableFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Blockchain wallet api service factory
 *
 * Creates the blockchain wallet api service with dependencies
 */
class BlockchainWalletFactory extends AbstractConfigurableFactory implements FactoryInterface
{
    /**
     * Config name
     *
     * @var string
     */
    protected $name;

    /**
     * Initialize object
     *
     * @param string $name Config name
     */
    public function __construct($name = 'default')
    {
        $this->name = $name;
    }

    /**
     * Creates service depending on configuration
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @throws \Sake\BlockchainWalletApi\Exception\RuntimeException
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $this->getOptions($serviceLocator);

        if (empty($config['options'])) {
            throw new RuntimeException(
                sprintf(
                    'No options defined for config %s.%s.%s',
                    $this->getModule(),
                    $this->getScope(),
                    $this->getName()
                )
            );
        }
        $options = new BlockchainWalletOptions($config['options']);

        if (!isset($config['options']['hydrator'])) {
            $options->setHydrator($serviceLocator->get('sake_bwa.service.hydrator'));
        }
        return new BlockchainWallet($this->getClient($serviceLocator, $config), $options);
    }

    /**
     * Module name
     *
     * @return string
     */
    public function getModule()
    {
        return 'sake_bwa';
    }

    /**
     * Config scope
     *
     * @return string
     */
    public function getScope()
    {
        return 'connection';
    }

    /**
     * Config name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns http client from service manager or default will be created
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param array $config
     * @throws \Sake\BlockchainWalletApi\Exception\RuntimeException
     * @return \Zend\Http\Client
     */
    protected function getClient(ServiceLocatorInterface $serviceLocator, array $config)
    {
        if (empty($config['client'])) {
            $client = new \Zend\Http\Client();
            $client->getAdapter()->setOptions(array('sslverifypeer' => false));
        } else {
            $client = $serviceLocator->get($config['client']);
        }

        if (!$client instanceof \Zend\Http\Client) {
            throw new RuntimeException(
                sprintf('Class "%s" is not an instance of \Zend\Http\Client', get_class($client))
            );
        }
        return $client;
    }
}
