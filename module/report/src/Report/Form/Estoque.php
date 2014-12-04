<?php

namespace Report\Form;

use Zend\Form\Form;

class Estoque extends Form {

    public function __construct($name = null, $warehouses = array(), $options = array()) {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'post');
        
        $warehouse = new \Zend\Form\Element\Select();
        $warehouse->setLabel("Armazem: ")
                ->setName("warehouse")
                ->setOptions(array('value_options' => $warehouses));
        $this->add($warehouse);
        
        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn-success'
            )
        ));
    }

}
