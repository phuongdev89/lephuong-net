<?php

namespace backend\controllers;


use backend\bases\ControllerBase;

class IndexController extends ControllerBase
{
    public function accessControl()
    {
        return [
            'index' => 'private',
            'indec' => 'private',
        ];

    }

    public function indecAction()
    {
    }

    public function indexAction()
    {
    }
}
