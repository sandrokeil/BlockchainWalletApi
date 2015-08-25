<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 - 2015 Sandro Keil
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
     * Tests getConfig() should should return module configuration
     *
     * @covers \Sake\BlockchainWalletApi\Module::getConfig
     */
    public function testGetConfig()
    {
        $cut = new Module();
        $config = $cut->getConfig();
        $this->assertSame(
            @include 'config/module.config.php',
            $config,
            'Module configuration could not be read'
        );
    }
}
