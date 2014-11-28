<?php

namespace Warehouse\Service;

use Doctrine\ORM\EntityManager;
use Base\Service\AbstractService;

class Warehouse extends AbstractService
{    
    public function __construct(EntityManager $em) 
    {
        parent::__construct($em);
        
        $this->entity = "Warehouse\Entity\Warehouse";
    }
}
