<?php

/**
* Created by solutionDrive GmbH
*
* @copyright 2016 solutionDrive GmbH
*/

namespace devnight\geldannahme;

class TransactionFileManager
{
    protected $jsonPath = 'cage/';
    public function createJSONFileFor($transactionId)
    {
        if (is_file($this->jsonPath.$transactionId.'.json')) {
            return false;
        }

        $success = file_put_contents(__DIR__.'/../'.$this->jsonPath.$transactionId.'.json', '{"transactionid":"'.$transactionId.'"}');

        if ($success === false) {
            return false;
        }

        return $transactionId.'.json';
    }

    public function loadFile($transactionId)
    {
        if (is_file($this->jsonPath.$transactionId.'.json')) {
            return file_get_contents($this->jsonPath.$transactionId.'.json');
        }
    }

    public function saveToFile($id, $json)
    {
        return (bool)file_put_contents(__DIR__.'/../'.$this->jsonPath.$id.'.json', $json);
    }
}
