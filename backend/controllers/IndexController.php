<?php

namespace backend\controllers;


use backend\bases\ControllerBase;
use common\helpers\StringHelper;

class IndexController extends ControllerBase
{
    public function accessControl()
    {
        return [
            'index' => 'public',
            'indec' => 'public',
        ];

    }

    public function indecAction()
    {
    }

    public function indexAction()
    {
        $this->tag->setDefault('email', StringHelper::random());
    }
}
