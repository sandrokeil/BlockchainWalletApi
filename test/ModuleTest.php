<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace SakeTest\BlockchainWalletApi;

use \Sake\BlockchainWalletApi\Module;

/**
 * Class ModuleTest
 *
 * Tests integrity of \Sake\BlockchainWalletApi\Module
 */
class ModuleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests getServiceConfig() should should return service manager configuration
     *
     * @covers \Sake\BlockchainWalletApi\Module::getServiceConfig
     */
    public function testGetServiceConfig()
    {
        $cut = new Module();
        $config = $cut->getServiceConfig();
        $this->assertSame(
            @include 'config/service_manager.config.php',
            $config,
            'Service manager configuration could not be read'
        );
    }

    /**
     * Tests getViewHelperConfig() should should return view helper configuration
     *
     * @covers \Sake\BlockchainWalletApi\Module::getViewHelperConfig
     */
    public function testGetViewHelperConfig()
    {
        $cut = new Module();
        $config = $cut->getViewHelperConfig();
        $this->assertSame(
            @include 'config/view_helper.config.php',
            $config,
            'View helper configuration could not be read'
        );
    }
}
