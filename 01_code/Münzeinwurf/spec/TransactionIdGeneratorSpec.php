<?php

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2016 solutionDrive GmbH
 */

namespace spec\devnight\geldannahme;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class TransactionIdGeneratorSpec
 *
 * @package spec\devnight\geldannahme
 * @mixin \devnight\geldannahme\TransactionIdGenerator
 */
class TransactionIdGeneratorSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('devnight\geldannahme\TransactionIdGenerator');
    }

    public function it_can_generate_unique_ids()
    {
        $this->generateId()->shouldNotEqual($this->generateId());
    }
}
