<?php

namespace Warehouse\Controller;

use Zend\View\Model\ViewModel;
use Base\Controller\CrudController;

class WarehouseController extends CrudController {

    public function __construct() 
    {
        $this->entity = "Warehouse\Entity\Warehouse";
        $this->form = "Warehouse\Form\Warehouse";
        $this->service = "Warehouse\Service\Warehouse";
        $this->controller = "warehouse";
        $this->route = "warehouse";
    }
}
