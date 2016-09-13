<?php

/**
* Created by solutionDrive GmbH
*
* @copyright 2016 solutionDrive GmbH
*/

namespace devnight\geldannahme;

class TransactionManager
{
    /** @var  TransactionFileManager */
    protected $transactionFileManager;
    /** @var  TransactionIdGenerator */
    protected $transactionIdGenerator;

    protected $transactionData;

    protected $transactionDataJson;

    protected $transactionId;

    public function __construct($transactionIdGenerator, $transactionFileManager)
    {
        $this->transactionIdGenerator = $transactionIdGenerator;
        $this->transactionFileManager = $transactionFileManager;
    }

    public function startTransaction()
    {
        $fileName = false;
        while ($fileName === false) {
            $transactionId = $this->transactionIdGenerator->generateId();
            $fileName = $this->transactionFileManager->createJSONFileFor($transactionId);
        }
        return $transactionId;
    }

    public function loadTransaction($transactionId)
    {
        $this->transactionId = $transactionId;
        $this->transactionDataJson = $this->transactionFileManager->loadFile($transactionId);
        $this->transactionData = json_decode($this->transactionDataJson, true);
        return $this->transactionDataJson;
    }

    public function updateTransaction($amount, $currency)
    {
        $this->transactionData['amount'] = $amount;
        $this->transactionData['currency'] = $currency;
        $this->transactionDataJson = json_encode($this->transactionData);
        $this->transactionFileManager->saveToFile($this->transactionId, $this->transactionDataJson);
        return $this->transactionDataJson;
    }
}
