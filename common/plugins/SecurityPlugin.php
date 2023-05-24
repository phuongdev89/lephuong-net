<?php

namespace common\plugins;

use common\enums\Acl;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Component;
use Phalcon\Acl\Enum;
use Phalcon\Acl\Role;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

/**
 * @class       backend\plugins\SecurityPlugin
 * @project     lephuong-net
 * @author      Phuong Dev <phuongdev89@gmail.com>
 * @datetime    5/24/2023 10:21 AM
 * @description This is the security plugin which controls that users only have access to the modules they're assigned to
 * @since       4.1.2
 */
class SecurityPlugin extends Injectable
{
    const ROLE_USER = 'Users';

    const ROLE_GUEST = 'Guests';

    const ROLE = [
        self::ROLE_USER => 'Member privileges, granted after sign in.',
        self::ROLE_GUEST => 'Anyone browsing the site who is not signed in is considered to be a "Guest".'
    ];

    /**
     * This action is executed before execute any action in the application
     *
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return bool
     * @since 4.1.2
     */
    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        $controller = $dispatcher->getActiveController();
        if (method_exists($controller, 'accessControl')) {
            $auth = $this->session->get('auth');
            if (!$auth) {
                $role = self::ROLE_GUEST;
            } else {
                $role = self::ROLE_USER;
            }

            $controller_name = $dispatcher->getControllerName();
            $actionName = $dispatcher->getActionName();
            $acl = $this->getAcl($dispatcher);
            if (!$acl->isComponent($controller_name)) {
                $dispatcher->forward([
                    'controller' => 'error',
                    'action' => 'show401',
                ]);

                return false;
            }

            $allowed = $acl->isAllowed($role, $controller_name, $actionName);
            if (!$allowed) {
                $dispatcher->forward([
                    'controller' => 'security',
                    'action' => 'login',
                ]);

                $this->session->destroy();

                return false;
            }

        }
        return true;
    }


    /**
     * This function will get access control rules from controller
     *
     * @param $dispatcher
     * @return   AclList
     * @author   Phuong Dev <phuongdev89@gmail.com>
     * @datetime 5/23/2023 12:15 AM
     * @since 4.1.2
     */
    protected function getAcl($dispatcher): AclList
    {
        $controller = $dispatcher->getActiveController();
        $controller_name = $dispatcher->getControllerName();
        $acl_rules = $controller->accessControl();

        if ($this->persistent->has('acl')) {
            $acl = $this->persistent->get('acl');
        } else {
            $acl = new AclList();
            $acl->setDefaultAction(Enum::DENY);
            foreach (self::ROLE as $role_name => $description) {
                $role = new Role($role_name, $description);
                $acl->addRole($role);
            }
        }

        $need_add_component = true;
        if ($acl->getComponents() != null) {
            foreach ($acl->getComponents() as $component) {
                if ($component->getName() == $controller_name) {
                    $need_add_component = false;
                    break;
                }
            }
        }

        if ($need_add_component) {
            $acl->addComponent(new Component($controller_name), array_keys($acl_rules));
            foreach ($acl_rules as $action => $type) {
                if ($type == Acl::PUBLIC) {
                    foreach ($acl->getRoles() as $role) {
                        $acl->allow($role->getName(), $controller_name, $action);
                    }
                } else {
                    $acl->allow(self::ROLE_USER, $controller_name, $action);
                }
            }
        }

        //The acl is stored in session, APC would be useful here too
        $this->persistent->set('acl', $acl);

        return $acl;
    }
}
