<?php

/**
 * Created by solutionDrive GmbH
 *
 * @copyright 2016 solutionDrive GmbH
 */

namespace spec\devnight\geldannahme;

use devnight\geldannahme\TransactionFileManager;
use devnight\geldannahme\TransactionIdGenerator;
use devnight\geldannahme\TransactionManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class TransactionManagerSpec^
 *
 * @package spec\devnight\geldannahme
 * @mixin \devnight\geldannahme\TransactionManager
 */
class TransactionManagerSpec extends ObjectBehavior
{
    public function let(TransactionIdGenerator $transactionIdGenerator, TransactionFileManager $transactionFileManager)
    {
        $this->beConstructedWith($transactionIdGenerator, $transactionFileManager);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(TransactionManager::class);
    }

    public function it_can_start_a_transaction(TransactionIdGenerator $transactionIdGenerator, TransactionFileManager $transactionFileManager)
    {
        $id = 'xyz';
        $transactionIdGenerator->generateId()->willReturn($id)->shouldBeCalled();
        $transactionFileManager->createJSONFileFor($id)->willReturn($id.'.json')->shouldBeCalled();
        $this->startTransaction()->shouldReturn($id);
    }

    public function it_can_load_a_transaction(TransactionFileManager $transactionFileManager)
    {
        $id = 'xyz';
        $jsonContent = '{"transactionid":"'.$id.'"}';
        $transactionFileManager->loadFile($id)->willReturn($jsonContent)->shouldBeCalled();
        $this->loadTransaction($id)->shouldReturn($jsonContent);
    }

    public function it_can_update_a_transaction(TransactionFileManager $transactionFileManager)
    {
        $id = 'xyz';
        $amount = 2.50;
        $currency = 'EUR';

        $jsonContentBeforeUpdate = '{"transactionid":"'.$id.'"}';
        $jsonContentAfterUpdate = '{"transactionid":"'.$id.'","amount":'.$amount.',"currency":"'.$currency.'"}';

        $transactionFileManager->loadFile($id)->willReturn($jsonContentBeforeUpdate)->shouldBeCalled();
        $this->loadTransaction($id)->shouldReturn($jsonContentBeforeUpdate);

        $this->updateTransaction($amount, $currency)->shouldReturn($jsonContentAfterUpdate);
    }
}
