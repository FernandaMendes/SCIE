<?php

namespace Item\Controller;

use Zend\View\Model\ViewModel;
use Base\Controller\CrudController;

class ItemController extends CrudController {

    public function __construct() 
    {
        $this->entity = "Item\Entity\Item";
        $this->form = "Item\Form\Item";
        $this->service = "Item\Service\Item";
        $this->controller = "Item";
        $this->route = "Item";
    }
    
    public function newAction()
    {
        $form = $this->getServiceLocator()->get('Item\Form\Item');
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                $service->insert($request->getPost()->toArray());
                
                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }
        
        return new ViewModel(array('form'=>$form));
    }
    
    public function editAction()
    {
        $form = $this->getServiceLocator()->get('Item\Form\Item');
        $request = $this->getRequest();
        
        $repository = $this->getEm()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id',0));
        
        if($this->params()->fromRoute('id',0))
            $form->setData($entity->toArray());
        
        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());
                
                return $this->redirect()->toRoute($this->route,array('controller'=>$this->controller));
            }
        }
        
        return new ViewModel(array('form'=>$form));
    }
}
