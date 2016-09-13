<?php


class AutomatenFormularCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    public function iSeeAInputField(AcceptanceTester $I)
    {
        $I->amOnPage("/");
        $I->seeElement("input[name=amount]");
    }

    public function iCheckFormTag(AcceptanceTester $I)
    {
        $I->amOnPage("/");
        $I->seeElement("form", [
            'method'  => 'post',
            'enctype' => 'application/x-www-form-urlencoded'
        ]);
    }

    public function iCannotBuyOneMateBecauseOutOfOrder(AcceptanceTester $I)
    {
        $I->amOnPage("/");
        $I->submitForm('form', ['amount' => 1], 'order_button');
        $I->see('Automat ausser Betrieb');
    }
}
