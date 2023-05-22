<?php
/**
 * Created by Le Phuong.
 * @file     SecurityPlugin.php
 * @project  lephuong-net
 * @author   Phuong Dev <phuongdev89@gmail.com>
 * @datetime 5/22/2023 12:18 AM
 */

namespace backend\plugins;

use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Component;
use Phalcon\Acl\Enum;
use Phalcon\Acl\Role;
use Phalcon\Config;
use Phalcon\Di\Injectable;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;

/**
 * @property Config $config
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

            $controllerName = $dispatcher->getControllerName();
            $actionName = $dispatcher->getActionName();
            $acl = $this->getAcl($dispatcher);
            if (!$acl->isComponent($controllerName)) {
                $dispatcher->forward([
                    'controller' => 'error',
                    'action' => 'show401',
                ]);

                return false;
            }

            $allowed = $acl->isAllowed($role, $controllerName, $actionName);
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
     * @param $dispatcher
     * @return   AclList
     * @author   Phuong Dev <phuongdev89@gmail.com>
     * @datetime 5/23/2023 12:15 AM
     *
     */
    protected function getAcl($dispatcher): AclList
    {
        $controller = $dispatcher->getActiveController();
        $controllerName = $dispatcher->getControllerName();
        $aclRules = $controller->accessControl();

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
                if ($component->getName() == $controllerName) {
                    $need_add_component = false;
                    break;
                }
            }
        }

        if ($need_add_component) {
            $acl->addComponent(new Component($controllerName), array_keys($aclRules));
            foreach ($aclRules as $action => $type) {
                if ($type == 'public') {
                    foreach ($acl->getRoles() as $role) {
                        $acl->allow($role->getName(), $controllerName, $action);
                    }
                } else {
                    $acl->allow(self::ROLE_USER, $controllerName, $action);
                }
            }
        }

        //The acl is stored in session, APC would be useful here too
        $this->persistent->set('acl', $acl);

        return $acl;
    }
}
