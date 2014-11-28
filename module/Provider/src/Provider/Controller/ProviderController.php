<?php

namespace Provider\Controller;

use Zend\View\Model\ViewModel;
use Base\Controller\CrudController;

class ProviderController extends CrudController {

    public function __construct() 
    {
        $this->entity = "Provider\Entity\Provider";
        $this->form = "Provider\Form\Provider";
        $this->service = "Provider\Service\Provider";
        $this->controller = "Provider";
        $this->route = "Provider";
    }
}
