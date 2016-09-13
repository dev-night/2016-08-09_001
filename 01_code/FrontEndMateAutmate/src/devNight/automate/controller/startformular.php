<?php

/**
 * Created by Tobias Matthaiou
 * 
 * @copyright 2016 Tobias Matthaiou
 */

namespace devNight\automate\controller;

/**
 * Class startformular
 */
class startformular
{
    protected $sError = null;

    public function getHTML()
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . "/../../../templates/");
        $twig = new \Twig_Environment($loader, ['cache' => __DIR__ . "/../../../../tmp/"]);

        return  $twig->render('startformular.html.twig', ['error_message' => $this->sError]);
    }

    public function setErrorMessage($sError)
    {
        $this->sError = $sError;
    }

}