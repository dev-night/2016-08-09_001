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
 * Class TransactionFileManagerSpec
 *
 * @package spec\devnight\geldannahme
 * @mixin \devnight\geldannahme\TransactionFileManager
 */
class TransactionFileManagerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('devnight\geldannahme\TransactionFileManager');
    }

    public function it_can_create_a_json_file_for_given_id()
    {
        $id = '123';
        $this->createJSONFileFor($id)->shouldReturn($id.'.json');
        unlink(__DIR__.'/../cage/'.$id.'.json');
    }

    public function it_will_not_create_the_same_file()
    {
        $id = '123';
        $this->createJSONFileFor($id)->shouldReturn($id.'.json');
        $this->createJSONFileFor($id)->shouldReturn(false);
        unlink(__DIR__.'/../cage/'.$id.'.json');
    }

    public function it_can_load_a_file()
    {
        $id = '123';
        $this->createJSONFileFor($id);
        $this->loadFile($id)->shouldReturn('{"transactionid":"'.$id.'"}');
        unlink(__DIR__.'/../cage/'.$id.'.json');
    }

    public function it_can_save_a_file()
    {
        $id = '123';
        $json = '{"transactionid":"'.$id.'","updated":true}';
        $this->createJSONFileFor($id);
        $this->loadFile($id)->shouldReturn('{"transactionid":"'.$id.'"}');
        $this->saveToFile($id, $json)->shouldReturn(true);
        $this->loadFile($id)->shouldReturn($json);
        unlink(__DIR__.'/../cage/'.$id.'.json');
    }
}
