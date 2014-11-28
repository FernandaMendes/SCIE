<?php

namespace Provider\Service;

use Doctrine\ORM\EntityManager;
use Base\Service\AbstractService;

class Provider extends AbstractService
{    
    public function __construct(EntityManager $em) 
    {
        parent::__construct($em);
        
        $this->entity = "Provider\Entity\Provider";
    }
}
