<?php

/**
* Created by solutionDrive GmbH
*
* @copyright 2016 solutionDrive GmbH
*/

namespace devnight\geldannahme;

class TransactionIdGenerator
{
    const NUMBER_OF_BLOCKS = 3;

    protected $id;

    public function generateId()
    {
        return $this->id = strtoupper(join('', str_split(bin2hex(openssl_random_pseudo_bytes(2 * self::NUMBER_OF_BLOCKS)), 4)));
    }
}
