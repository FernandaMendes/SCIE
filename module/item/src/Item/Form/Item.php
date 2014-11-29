<?php

namespace Item\Form;

use Zend\Form\Form;

class Item extends Form {

    public function __construct($name = null, $providers = array(), $warehouses = array(), $options = array()) {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setLabel("Nome: ")
                ->setAttribute('placeholder', 'Entre com o nome');
        $this->add($nome);

        $provider = new \Zend\Form\Element\Select();
        $provider->setLabel("Fornecedor: ")
                ->setName("provider")
                ->setOptions(array('value_options' => $providers));
        $this->add($provider);
        
        $warehouse = new \Zend\Form\Element\Select();
        $warehouse->setLabel("Armazem: ")
                ->setName("warehouse")
                ->setOptions(array('value_options' => $warehouses));
        $this->add($warehouse);
        
        $this->add(array(
            'name' => 'descript',
            'type' => 'Zend\Form\Element\TextArea',
            'options' => array(
                'label' => 'Descrição: ',
            ),
            'attributes' => array(
                'class' => ''
            )
        ));

        $this->add(array(
            'name' => 'cost',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Custo: ',
            ),
            'attributes' => array(
                'placeholder' => 'Apenas numeros',
                'class' => ''
            )
        ));

        $this->add(array(
            'name' => 'qtde',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Quantidade: ',
            ),
            'attributes' => array(
                'placeholder' => 'Apenas numeros',
                'class' => ''
            )
        ));

        $radioS = new \Zend\Form\Element\Radio('status');
        $radioS->setLabel('Armazem Ativo ?');
        $radioS->setValueOptions(array(
            '0' => 'Sim',
            '1' => 'Não',
        ));
        $this->add($radioS);

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
