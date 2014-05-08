<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Validator;

use Sake\BlockchainWalletApi\Validator\Exception\ValidatorException;
use Zend\Validator\AbstractValidator;

/**
 * Validates a bitcoin address
 *
 * For more details see https://en.bitcoin.it/wiki/Address#Address_validation
 */
class BitcoinAddress extends AbstractValidator
{
    /**#@+
     * Validity constants
     * @var string
     */
    const INVALID        = 'dateInvalid';
    const INVALID_VERSION   = 'bitcionAddressInvalidVersion';
    /**#@-*/

    /**
     * Validation failure message template definitions
     *
     * @var array
     */
    protected $messageTemplates = array(
        self::INVALID      => "The input is not a valid bitcoin address",
        self::INVALID_VERSION => 'The input does not appear to be a valid bitcoin address version "00"',
    );

    /**
     * Returns true if and only if $value meets the validation requirements
     *
     * If $value fails validation, then this method returns false, and getMessages() will return an array of messages
     * that explain why the validation failed.
     *
     * @param  string $value Bitcoin address
     * @return bool
     * @throws ValidatorException If validation of $value is impossible
     */
    public function isValid($value)
    {
        $address = $this->decode((string) $value);

        if (strlen($address) != 50) {
            throw new ValidatorException(sprintf('Could not decode bitcoin address "%s"', $value));
        }
        // check version
        if (hexdec(substr($address, 0, 2)) > hexdec('00')) {
            $this->error(self::INVALID_VERSION);
            return false;
        }
        // creating a Base58Check string
        $checksum = pack('H*', substr($address, 0, strlen($address) - 8));
        $checksum = strtoupper(hash('sha256', hash('sha256', $checksum, true)));
        $checksum = substr($checksum, 0, 8);

        if ($checksum === substr($address, strlen($address) - 8)) {
            return true;
        }
        $this->error(self::INVALID);
        return false;
    }

    /**
     * Decode bitcoin address to hex representation
     *
     * @param string $address Bitcoin address
     * @return string
     */
    protected function decode($address)
    {
        $originBase58 = $address;

        $chars = '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz';
        $return = '0';

        $length = strlen($address);

        for ($i = 0; $i < $length; $i++) {
            $current = (string) strpos($chars, $address[$i]);
            $return = (string) bcmul($return, '58', 0);
            $return = (string) bcadd($return, $current, 0);
        }
        $return = $this->encodeHex($return);

        // add leading zeros
        for ($i = 0; $i < strlen($originBase58) && $originBase58[$i] == '1'; $i++) {
            $return = '00' . $return;
        }

        if (strlen($return) % 2 != 0) {
            $return = '0' . $return;
        }
        return $return;
    }

    /**
     * Encodes integer to hex representation
     *
     * @param string $decimal
     * @return string
     */
    protected function encodeHex($decimal)
    {
        $chars = '0123456789ABCDEF';
        $hex = '';

        while (bccomp($decimal, 0) == 1) {
            $division = (string) bcdiv($decimal, '16', 0);
            $rem      = (int) bcmod($decimal, '16');
            $decimal  = $division;

            $hex .= $chars[$rem];
        }
        return strrev($hex);
    }
}
