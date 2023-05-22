<?php
/**
 * Created by Le Phuong.
 * @file     SecurityController.php
 * @project  lephuong-net
 * @author   Phuong Dev <phuongdev89@gmail.com>
 * @datetime 5/22/2023 12:09 AM
 */

namespace backend\controllers;

use backend\bases\ControllerBase;

class SecurityController extends ControllerBase
{

    public function accessControl()
    {
        return [
            'index' => 'public',
            'login' => 'public',
        ];

    }


    private function _registerSession($user)
    {
        $this->session->set(
            'auth',
            [
                'id' => $user->id,
                'name' => $user->name,
            ]
        );
    }

    public function indexAction()
    {
        $this->tag->setDefault('email', 'demo');
        $this->tag->setDefault('password', 'phalcon');
    }

    public function loginAction()
    {
        if (true === $this->request->isPost()) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            $user = User::findFirst(
                [
                    "(email = :email: OR username = :email:) " .
                    "AND password = :password: " .
                    "AND active = 'Y'",
                    'bind' => [
                        'email' => $email,
                        'password' => sha1($password),
                    ]
                ]
            );

            if (null !== $user) {
                $this->_registerSession($user);

                $this->flash->success(
                    'Welcome ' . $user->name
                );

                $this->dispatcher->forward(
                    [
                        'controller' => 'invoices',
                        'action' => 'index',
                    ]
                );
            }

            $this->flash->error(
                'Wrong email/password'
            );
        }

        $this->dispatcher->forward(
            [
                'controller' => 'security',
                'action' => 'index',
            ]
        );
    }
}
