<?php

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController,
    Zend\View\Model\ViewModel;

use User\Form\User as FormUser;

class IndexController extends AbstractActionController
{
    public function registerAction() 
    {
        $form = new FormUser;
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $data = $request->getPost();
                $data['ip'] = $request->getServer('REMOTE_ADDR');
                
                
                
                $service = $this->getServiceLocator()->get("CECUser\Service\User");
                if($service->insert($request->getPost()->toArray())) 
                {
                    $fm = $this->flashMessenger()
                            ->setNamespace('cecuser')
                            ->addMessage("Usuário cadastrado com sucesso");
                }
                
                return $this->redirect()->toRoute('cecuser-register');
            }
        }
        
        $messages = $this->flashMessenger()
                ->setNamespace('cecuser')
                ->getMessages();
        
        return new ViewModel(array('form'=>$form,'messages'=>$messages));
    }
    
    public function activateAction()
    {
        $activationKey = $this->params()->fromRoute('key');
        
        $userService = $this->getServiceLocator()->get('CECUser\Service\User');
        $result = $userService->activate($activationKey);
        
        if($result)
            return new ViewModel(array('user'=>$result));
        else
            return new ViewModel();
    }
}
