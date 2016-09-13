<?php

/**
 * Created by Tobias Matthaiou
 * 
 * @copyright 2016 Tobias Matthaiou
 */

namespace spec\devNight\automate\controller;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class startformularSpec
 *
 * @mixin \devNight\automate\controller\startformular
 */
class startformularSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('devNight\automate\controller\startformular');
    }

    public function it_display_form()
    {
        $this->getHTML()->shouldContain('<html>');
    }

    public function it_set_error_message()
    {
        $this->setErrorMessage('Toller Error');
        $this->getHTML()->shouldContain('Toller Error');
    }
}