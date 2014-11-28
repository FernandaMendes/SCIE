<?php

namespace Provider\Form;

use Zend\Form\Form;

class Provider extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setLabel("Nome: ")
                ->setAttribute('placeholder', 'Entre com o nome');
        $this->add($nome);

        $this->add(array(
            'name' => 'address',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Endereço: ',
            ),
            'attributes' => array(
                'placeholder' => 'Endereço',
                'class' => ''
            )
        ));

        $this->add(array(
            'name' => 'phone',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Telefone: ',
            ),
            'attributes' => array(
                'placeholder' => 'apenas numeros',
                'class' => ''
            )
        ));

        $this->add(array(
            'name' => 'city',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Cidade: ',
            ),
            'attributes' => array(
                'placeholder' => 'cidade',
                'class' => ''
            )
        ));

        $this->add(array(
            'name' => 'uf',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'UF: ',
            ),
            'attributes' => array(
                'placeholder' => 'UF',
                'class' => ''
            )
        ));
        
        $this->add(array(
            'name' => 'code',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Código: ',
            ),
            'attributes' => array(
                'placeholder' => 'Código',
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
