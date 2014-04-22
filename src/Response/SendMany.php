<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Response;

/**
 * Response for sendmany request
 *
 * This class contains the result data of the sendmany request
 */
class SendMany implements ResponseInterface
{
    /**
     * Response message
     *
     * @var string
     */
    protected $message;

    /**
     * Transaction hash
     *
     * @var string
     */
    protected $txHash;

    /**
     * Returns message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets message
     *
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = (string) $message;
    }

    /**
     * Returns transaction hash
     *
     * @return string
     */
    public function getTxHash()
    {
        return $this->txHash;
    }

    /**
     * Sets transaction hash
     *
     * @param string $transactionHash
     */
    public function setTxHash($transactionHash)
    {
        $this->txHash = (string) $transactionHash;
    }
}
