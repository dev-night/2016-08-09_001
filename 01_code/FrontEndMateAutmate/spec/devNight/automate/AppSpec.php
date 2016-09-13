<?php

/**
 * Created by Tobias Matthaiou
 * 
 * @copyright 2016 Tobias Matthaiou
 */

namespace spec\devNight\automate;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class AppSpec
 *
 * @mixin \devNight\automate\App
 */
class AppSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('devNight\automate\App');
    }

    public function it_start_app()
    {
        ob_start();
        $this->run()->shouldReturn(null);
        ob_end_clean();
    }
}