<?php

/**
 * Created by Tobias Matthaiou
 * 
 * @copyright 2016 Tobias Matthaiou
 */

namespace devNight\automate;

/**
 * Class App
 */
class App
{
    public function run()
    {
        $controller = new \devNight\automate\controller\startformular();

        if (isset($_POST['order_button'])) {
            $controller->setErrorMessage('automat ausser betrieb');
        }

        print $controller->getHTML();
    }
}