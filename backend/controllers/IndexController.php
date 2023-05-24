<?php

namespace backend\controllers;


use backend\bases\ControllerBase;
use common\enums\Acl;
use common\helpers\StringHelper;

class IndexController extends ControllerBase
{
    public function accessControl()
    {
        return [
            'index' => Acl::PUBLIC,
            'indec' => Acl::PUBLIC,
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
