<?php
namespace User;

use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;
use User\Auth\Adapter as AuthAdapter;
use Zend\ModuleManager\ModuleManager;

class Module {

    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
        return array(
            'factories' => array(
                'User\Service\User' => function($sm) {
                    return new Service\User($sm->get('Doctrine\ORM\EntityManager'));
                },
                'User\Auth\Adapter' => function($sm) {
                    return new AuthAdapter($sm->get('Doctrine\ORM\EntityManager'));
                }
            )
        );
    }

    public function getViewHelperConfig() {
        return array(
            'invokables' => array(
                'UserIdentity' => new View\Helper\UserIdentity()
            )
        );
    }

}
