<?php
/**
 * Sake
 *
 * @link      http://github.com/sandrokeil/BlockchainWalletApi for the canonical source repository
 * @copyright Copyright (c) 2014 Sandro Keil
 * @license   http://github.com/sandrokeil/BlockchainWalletApi/blob/master/LICENSE.txt New BSD License
 */

namespace Sake\BlockchainWalletApi\Request;

/**
 * Request for payment method
 *
 * This class handles data for payment request
 */
class Send implements RequestInterface
{
    /**
     * Recipient Bitcoin Address
     *
     * @var string
     */
    protected $to;

    /**
     * Amount to send in satoshi
     *
     * @var int
     */
    protected $amount;

    /**
     * Send from a specific Bitcoin Address (Optional)
     *
     * @var string
     */
    protected $from;

    /**
     * "true" or "false" indicating whether the transaction should be sent through a shared wallet. Fees apply.
     * (Optional)
     *
     * @var bool
     */
    protected $shared;

    /**
     * Transaction fee value in satoshi (Must be greater than default fee) (Optional)
     *
     * @var int
     */
    protected $fee;

    /**
     * A public note to include with the transaction (Optional)
     *
     * @var string
     */
    protected $note;

    /**
     * Service method
     *
     * @return string
     */
    public function getMethod()
    {
        return 'payment';
    }

    /**
     * Returns arguments if set
     *
     * @return array Arguments
     */
    public function getArguments()
    {
        $args = array(
            'to' => $this->to,
            'amount' => $this->amount,
        );

        if (null !== $this->from) {
            $args['from'] = $this->from;
        }
        if (null !== $this->shared) {
            $args['shared'] = $this->shared;
        }
        if (null !== $this->fee) {
            $args['fee'] = $this->fee;
        }
        if (null !== $this->note) {
            $args['note'] = $this->note;
        }
        return $args;
    }

    /**
     * Returns amount to send in satoshi
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Sets amount to send in satoshi
     *
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = (int) $amount;
    }

    /**
     * Returns transaction fee value in satoshi
     *
     * @return int
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * Sets transaction fee value in satoshi (Must be greater than default fee) (Optional)
     *
     * @param int $fee
     */
    public function setFee($fee)
    {
        $this->fee = (int) $fee;
    }

    /**
     * Returns Recipient Bitcoin Address
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Sets Recipient Bitcoin Address
     *
     * @param string $from
     */
    public function setFrom($from)
    {
        $this->from = (string) $from;
    }

    /**
     * Returns note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Sets a public note to include with the transaction (Optional)
     *
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = (string) $note;
    }

    /**
     * Returns indicating whether the transaction should be sent through a shared wallet. Fees apply. (Optional)
     *
     * @return bool
     */
    public function getShared()
    {
        return $this->shared;
    }

    /**
     * Sets indicating whether the transaction should be sent through a shared wallet. Fees apply. (Optional)
     *
     * @param bool $shared
     */
    public function setShared($shared)
    {
        $this->shared = (bool) $shared;
    }

    /**
     * Returns recipient address
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Sets recipient address
     *
     * @param string $to
     */
    public function setTo($to)
    {
        $this->to = (string) $to;
    }
}
