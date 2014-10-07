<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Satoshi view helper
 *
 * Converts satoshi to other format e.g. btc
 */
class Satoshi extends AbstractHelper
{
    /**
     * Value is converted to BTC
     *
     * @var string
     */
    const UNIT_BTC = 'BTC';

    /**
     * Value is converted to mBTC
     *
     * @var string
     */
    const UNIT_MBTC = 'mBTC';

    /**
     * Value is converted to uBTC
     *
     * @var string
     */
    const UNIT_UBTC = 'uBTC';

    /**
     * Default unit
     *
     * @var string
     */
    protected $defaultUnit;

    /**
     * Converts satoshi to given unit
     *
     * @param int $satoshi Satoshi
     * @param string $unit Use UNIT_* constant, default BTC
     * @return float
     */
    public function __invoke($satoshi, $unit = null)
    {
        return $this->format($satoshi, $unit);
    }

    /**
     * @param string $unit Use UNIT_* constant
     */
    public function setDefaultUnit($unit)
    {
        $this->defaultUnit = $unit;
    }

    /**
     * @param $satoshi
     * @param $unit
     * @return float
     */
    protected function format($satoshi, $unit)
    {
        if (null === $unit) {
            $unit = $this->defaultUnit;
        }

        switch ($unit) {
            case self::UNIT_MBTC:
                $value = $satoshi / 100000;
                break;

            case self::UNIT_UBTC:
                $value = $satoshi / 100;
                break;

            case self::UNIT_BTC:
            default:
                $value = $satoshi / 100000000;
                break;
        }
        return $value;
    }
}
