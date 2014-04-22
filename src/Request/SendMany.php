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
 * Request for send many method
 *
 * This class handles data for send many request
 */
class SendMany implements RequestInterface
{
    /**
     * List of recipient objects
     *
     * @var array
     */
    protected $recipients = array();

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
        return 'sendmany';
    }

    /**
     * Returns arguments if set
     *
     * @return array Arguments
     */
    public function getArguments()
    {
        $recipients = array();
        $args = array();

        /* @var $recipient Recipient  */
        foreach ($this->recipients as $recipient) {
            $recipients[$recipient->getAddress()] = $recipient->getAmount();
        }
        $args['recipients'] = json_encode($recipients);

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
     * Returns list of recipients objects
     *
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * Sets recipients
     *
     * @param array $recipients List of recipient objects
     */
    public function setRecipients(array $recipients)
    {
        $this->recipients = $recipients;
    }
}
