<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;

use User\Form\Login as LoginForm;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $form = new LoginForm;
        $error = false;
        
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $data = $request->getPost()->toArray();
                
                // Criando Storage para gravar sessão da authtenticação
                $sessionStorage = new SessionStorage();
                
                $auth = new AuthenticationService;
                $auth->setStorage($sessionStorage); // Definindo o SessionStorage para a auth
                
                $authAdapter = $this->getServiceLocator()->get("User\Auth\Adapter");
                $authAdapter->setUsername($data['email']);
                $authAdapter->setPassword($data['password']);
    
                $result = $auth->authenticate($authAdapter);
                
                if($result->isValid())
                {

                    $user = $auth->getIdentity();
                    $user = $user['user'];
                    $sessionStorage->write($user,null);

                    
                    #$sessionStorage->write($auth->getIdentity()['user'],null);
                    return $this->redirect()->toRoute('login/default',array('controller'=>'users'));
                }
                else
                    $error = true; 
            }
        }
        
        return new ViewModel(array('form'=>$form,'error'=>$error));
    }
}
