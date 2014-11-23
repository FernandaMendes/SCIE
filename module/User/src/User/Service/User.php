<?php

namespace User\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Base\Service\AbstractService;

class User extends AbstractService
{    
    public function __construct(EntityManager $em) 
    {
        parent::__construct($em);
        
        $this->entity = "User\Entity\User";
    }
    
    public function insert(array $data) {
        $entity = parent::insert($data);
    }
    
    public function update(array $data)
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        
        if(empty($data['password']))
            unset($data['password']);
        
        (new Hydrator\ClassMethods())->hydrate($data, $entity);
        
        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }
    
}
