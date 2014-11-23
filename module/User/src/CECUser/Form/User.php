<?php

namespace CECUser\Form;

use Zend\Form\Form;

class User  extends Form
{

    public function __construct($name = null, $options = array()) {
        parent::__construct('user', $options);
        
        $this->setInputFilter(new UserFilter());
        $this->setAttribute('method', 'post');
        
        $id = new \Zend\Form\Element\Hidden('id');
        $this->add($id);
        
        $nome = new \Zend\Form\Element\Text("nome");
        $nome->setLabel("Nome: ")
                ->setAttribute('placeholder','Entre com o nome');
        $this->add($nome);
       
        $email = new \Zend\Form\Element\Text("email");
        $email->setLabel("Email: ")
                ->setAttribute('placeholder','Entre com o Email');
        $this->add($email);
       
        /*$password = new \Zend\Form\Element\Password("password");
        $password->setLabel("Password: ")
                ->setAttribute('placeholder','Entre com a senha');
        $this->add($password);
        
        $confirmation = new \Zend\Form\Element\Password("confirmation");
        $confirmation->setLabel("Redigite: ")
                ->setAttribute('placeholder','Redigite a senha');
        $this->add($confirmation);
        */
        $csrf = new \Zend\Form\Element\Csrf("security");
        $this->add($csrf);
        
        $this->add(array(
            'name' => 'cnpj',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'CNPJ: ',
            ),
            'attributes' => array(
                'placeholder'=>'CNPJ, apenas numeros',
                'class' => ''
            )
        ));
        
        $this->add(array(
            'name' => 'fantasy_name',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Nome fatasia: ',
            ),
            'attributes' => array(
                'placeholder'=>'Nome Fantasia',
                'class' => ''
            )
        ));
        
        $this->add(array(
            'name' => 'url',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'URL: ',
            ),
            'attributes' => array(
                'placeholder'=>'apenas se existir',
                'class' => ''
            )
        ));
        
        $this->add(array(
            'name' => 'phone',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Telefone: ',
            ),
            'attributes' => array(
                'placeholder'=>'apenas numeros',
                'class' => ''
            )
        ));
        
        $this->add(array(
            'name' => 'city',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'Cidade: ',
            ),
            'attributes' => array(
                'placeholder'=>'cidade',
                'class' => ''
            )
        ));
        
        $this->add(array(
            'name' => 'uf',
            'type'=>'Zend\Form\Element\Text',
            'options' => array(
                'label' => 'UF: ',
            ),
            'attributes' => array(
                'placeholder'=>'apenas iniciais',
                'class' => ''
            )
        ));
        
        $this->add(array(
            'name' => 'submit',
            'type'=>'Zend\Form\Element\Submit',
            'attributes' => array(
                'value'=>'Salvar',
                'class' => 'btn-success'
            )
        ));
                
       
    }
    
}
