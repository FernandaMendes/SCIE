<?php
namespace Provider;

use Zend\Mvc\MvcEvent;

use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use User\Auth\Adapter as AuthAdapter;

use Zend\ModuleManager\ModuleManager;

class Module
{
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        
        return array(
          'factories' => array(
              'Provider\Service\Provider' => function($sm) {
                  return new Service\Provider($sm->get('Doctrine\ORM\EntityManager'));
              },
              
          )  
        );
        
    }
    
    public function getViewHelperConfig()
    {
        return array(
            'invokables' => array(
            )
        );
    }
}
