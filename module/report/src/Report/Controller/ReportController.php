<?php

namespace Report\Controller;

use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;

class ReportController extends AbstractActionController {
    
    protected $em;
    
    public function estoqueAction()
    {
        $form = $this->getServiceLocator()->get('Report\Form\Estoque');
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $form->setData($request->getPost());
            $armazem = $request->getPost();

            $list = $this->getEm()->getRepository('Item\Entity\Item')->findByWarehouse($armazem['warehouse']);
        
            if($list)
                return new ViewModel(array('list' => $list, 'form' => $form));
            else
                return new ViewModel(array('list' => null, 'form' => $form));
        }
        
        return new ViewModel(array('list' => null, 'form' => $form));
        
        
    }
    
    public function financeiroAction()
    {
        $form = $this->getServiceLocator()->get('Report\Form\Estoque');
        $request = $this->getRequest();
        
        if($request->isPost())
        {
            $form->setData($request->getPost());
            $armazem = $request->getPost();

            $list = $this->getEm()->getRepository('Item\Entity\Item')->findByFinance($armazem['warehouse']);
            
            if($list)
                return new ViewModel(array('list' => $list, 'form' => $form));
            else
                return new ViewModel(array('list' => null, 'form' => $form));
        }
        
        return new ViewModel(array('list' => null, 'form' => $form));
    }
    
    protected function getEm()
    {
        if(null === $this->em)
            $this->em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        
        return $this->em;
    }
}
