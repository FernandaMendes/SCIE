<?php

namespace Item;

use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;
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
                'Item\Service\Item' => function($sm) {
                    return new Service\Item($sm->get('Doctrine\ORM\EntityManager'));
                },
                'Item\Form\Item' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $provider = $em->getRepository('Provider\Entity\Provider');
                    $providers = $provider->fetchPairs();

                    $wahoreuse = $em->getRepository('Warehouse\Entity\Warehouse');
                    $wahoreuses = $wahoreuse->fetchPairs();

                    return new Form\Item("Item", $providers, $wahoreuses);
                },
            )
        );
    }

    public function getViewHelperConfig() {
        return array(
            'invokables' => array(
            )
        );
    }

}
