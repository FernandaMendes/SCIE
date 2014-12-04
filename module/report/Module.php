<?php

namespace Report;

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
                'Report\Service\Report' => function($sm) {
                    return new Service\Report($sm->get('Doctrine\ORM\EntityManager'));
                },
                'Report\Form\Estoque' => function($sm) {
                    $em = $sm->get('Doctrine\ORM\EntityManager');
                    $wahoreuse = $em->getRepository('Warehouse\Entity\Warehouse');
                    $wahoreuses = $wahoreuse->fetchPairs();

                    return new Form\Estoque("Report", $wahoreuses);
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
