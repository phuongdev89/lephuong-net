<?php
/**
 * Created by Le Phuong.
 * @file     NotfoundPlugin.php
 * @project  lephuong-net
 * @author   Phuong Dev <phuongdev89@gmail.com>
 * @datetime 5/22/2023 12:39 AM
 */

namespace backend\plugins;


use Exception;
use Phalcon\Di\Injectable;
use Phalcon\Dispatcher\Exception as DispatcherException;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher as MvcDispatcher;
use Phalcon\Mvc\Dispatcher\Exception as MvcDispatcherException;

/**
 * NotFoundPlugin
 *
 * Handles not-found controller/actions
 */
class NotFoundPlugin extends Injectable
{
    /**
     * This action is executed before perform any action in the application
     *
     * @param Event $event
     * @param MvcDispatcher $dispatcher
     * @param Exception $exception
     * @return bool
     */
    public function beforeException(Event $event, MvcDispatcher $dispatcher, Exception $exception)
    {
        error_log($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());

        if ($exception instanceof MvcDispatcherException) {
            switch ($exception->getCode()) {
                case DispatcherException::EXCEPTION_HANDLER_NOT_FOUND:
                case DispatcherException::EXCEPTION_ACTION_NOT_FOUND:
                    $dispatcher->forward([
                        'controller' => 'errors',
                        'action' => 'show404',
                    ]);

                    return false;
            }
        }

        if ($dispatcher->getControllerName() !== 'errors') {
            $dispatcher->forward([
                'controller' => 'errors',
                'action' => 'show500',
            ]);
        }

        return !$event->isStopped();
    }
}
