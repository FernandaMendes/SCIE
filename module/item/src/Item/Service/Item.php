<?php

namespace Item\Service;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator;
use Base\Service\AbstractService;

class Item extends AbstractService {

    public function __construct(EntityManager $em)
    {
        parent::__construct($em);

        $this->entity = "Item\Entity\Item";
    }

    public function insert(array $data) 
    {
        $entity = new $this->entity($data);

        $wh = $this->em->getReference("Warehouse\Entity\Warehouse", $data['warehouse']);
        $entity->setWarehouse($wh); // Injetando entidade carregada

        $provider = $this->em->getReference("Provider\Entity\Provider", $data['provider']);
        $entity->setProvider($provider); // Injetando entidade carregada

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

    public function update(array $data) 
    {
        $entity = $this->em->getReference($this->entity, $data['id']);
        (new Hydrator\ClassMethods())->hydrate($data, $entity);

        $wh = $this->em->getReference("Warehouse\Entity\Warehouse", $data['provider']);
        $entity->setWarehouse($wh); // Injetando entidade carregada

        $provider = $this->em->getReference("Provider\Entity\Provider", $data['warehouse']);
        $entity->setProvider($provider); // Injetando entidade carregada

        $this->em->persist($entity);
        $this->em->flush();
        return $entity;
    }

}
