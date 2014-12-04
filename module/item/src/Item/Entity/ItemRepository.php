<?php

namespace Item\Entity;

use Doctrine\ORM\EntityRepository;

class ItemRepository extends EntityRepository {

    public function findByWarehouse($armazem) {

        $itens = $this->findAll();
        $a = array();
        foreach ($itens as $item) {
            if ($armazem == $item->getWarehouse()->getId()) {
                $a[$item->getId()]['nome'] = $item->getNome();
                $a[$item->getId()]['qtde'] = $item->getQtde();
            }
        }
        return $a;
    }
    
    public function findByFinance($armazem) {

        $itens = $this->findAll();
        $a = array();
        foreach ($itens as $item) {
            if ($armazem == $item->getWarehouse()->getId()) {
                $a[$item->getId()]['nome'] = $item->getNome();
                $a[$item->getId()]['total'] = ($item->getQtde() * $item->getCost());
            }
        }
        return $a;
    }

}
