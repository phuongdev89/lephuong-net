<?php
/**
 * Created by Le Phuong.
 * @file     ErrorController.php
 * @project  lephuong-net
 * @author   Phuong Dev <phuongdev89@gmail.com>
 * @datetime 5/23/2023 1:21 AM
 */

namespace backend\controllers;

use backend\bases\ControllerBase;

class ErrorController extends ControllerBase
{
    public function show404Action()
    {
        echo 404;
    }

    public function show401Action()
    {
        echo 401;
    }
}
