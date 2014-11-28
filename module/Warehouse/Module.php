<?php
namespace Warehouse;

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
    
    public function init(ModuleManager $moduleManager)
    {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        
        $sharedEvents->attach("Zend\Mvc\Controller\AbstractActionController", 
                MvcEvent::EVENT_DISPATCH,
                array($this,'validaAuth'),100);
    }
    
    public function validaAuth($e)
    {
        $auth = new AuthenticationService;
        $auth->setStorage(new SessionStorage());
        
        $controller = $e->getTarget();
        $matchedRoute = $controller->getEvent()->getRouteMatch()->getMatchedRouteName();

        
        if(!$auth->hasIdentity() and ($matchedRoute == "CECUser-admin" OR $matchedRoute == "CECUser-admin/paginator"))
            return $controller->redirect()->toRoute("CECUser-auth");
    }
    
    public function getServiceConfig()
    {
        
        return array(
          'factories' => array(
              'Warehouse\Service\Warehouse' => function($sm) {
                  return new Service\Warehouse($sm->get('Doctrine\ORM\EntityManager'));
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
