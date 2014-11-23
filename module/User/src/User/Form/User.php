<?php

namespace User\Form;

use Zend\Form\Form;

class User extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct($name, $options);

        $this->setAttribute('method', 'post');

        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);

        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setLabel("Nome: ")
                ->setAttribute('placeholder', 'Entre com o nome');
        $this->add($nome);

        $email = new \Zend\Form\Element\Text("email");
        $email->setLabel("Email: ")
                ->setAttribute('placeholder', 'Entre com o Email');
        $this->add($email);

        $password = new \Zend\Form\Element\Password("password");
        $password->setLabel("Password: ")
                ->setAttribute('placeholder', 'Entre com a senha');
        $this->add($password);

        $this->add(array(
            'name' => 'cpf',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'CPF: ',
            ),
            'attributes' => array(
                'placeholder' => 'CPF, apenas numeros',
                'class' => ''
            )
        ));

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

        $radio = new \Zend\Form\Element\Radio('type');
        $radio->setLabel('Tipo de usuario:');
        $radio->setValueOptions(array(
                '0' => 'Usuario',
                '1' => 'Admin',
        ));
        $this->add($radio);
        
        $this->add(array(
            'name' => 'department',
            'type' => 'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Departamento: ',
            ),
            'attributes' => array(
                'placeholder' => 'Departamento',
                'class' => ''
            )
        ));
        
        $radioS = new \Zend\Form\Element\Radio('status');
        $radioS->setLabel('Usuario Ativo ?');
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
