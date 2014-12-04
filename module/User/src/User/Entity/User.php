<?php

namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\Math\Rand,
    Zend\Crypt\Key\Derivation\Pbkdf2;

use Zend\Stdlib\Hydrator;

/**
 * CECUserUsers
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="User\Entity\UserRepository")
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;
    
    /**
     * @var string
     *
     * @ORM\Column(name="telefone", type="string", length=15, nullable=false)
     */
    private $phone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cidade", type="string", length=255, nullable=false)
     */
    private $city;
    
    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=2, nullable=false)
     */
    private $uf;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=11, nullable=false)
     */
    private $cpf;
    
    /**
     * @var string
     *
     * @ORM\Column(name="endereco", type="string", length=255, nullable=false)
     */
    private $address;
    
    /**
     * @var int
     *
     * @ORM\Column(name="tipo", nullable=false)
     */
    private $type;
    
    /**
     * @var int
     *
     * @ORM\Column(name="departamento", nullable=true)
     */
    private $department;  
    
    /**
     * @var int
     *
     * @ORM\Column(name="status", nullable=true)
     */
    private $status;
    
    public function __construct(array $options = array()) 
    {
        /*
        $hydrator = new Hydrator\ClassMethods;
        $hydrator->hydrate($options, $this);
        */
        
        $this->salt = base64_encode(Rand::getBytes(8, true));
        $this->password = $this->encryptPassword($this->password);
        
        
        (new Hydrator\ClassMethods)->hydrate($options,$this);
        
        $this->activationKey = md5($this->email.$this->salt);
        
        
    }
    
    public function encryptPassword($password)
    {
        return base64_encode(Pbkdf2::calc('sha256', $password, $this->salt, 10000, strlen($password*2)));
    }
    
    function getId() 
    {
        return $this->id;
    }

    function getNome() 
    {
        return $this->nome;
    }

    function getEmail() 
    {
        return $this->email;
    }

    function getPassword() 
    {
        return $this->password;
    }

    function getSalt() 
    {
        return $this->salt;
    }

    function getPhone() 
    {
        return $this->phone;
    }

    function getCity() 
    {
        return $this->city;
    }

    function getUf() 
    {
        return $this->uf;
    }

    function getCpf() 
    {
        return $this->cpf;
    }

    function getAddress() 
    {
        return $this->address;
    }

    function getType() 
    {
        return $this->type;
    }

    function getDepartment() 
    {
        return $this->department;
    }

    function getStatus() 
    {
        return $this->status;
    }

    function setId($id) 
    {
        $this->id = $id;
        return $this;
    }

    function setNome($nome) 
    {
        $this->nome = $nome;
        return $this;
    }

    function setEmail($email) 
    {
        $this->email = $email;
        return $this;
    }

    function setPassword($password) 
    {
        $this->password = $password;
        return $this;
    }

    function setSalt($salt) 
    {
        $this->salt = $salt;
        return $this;
    }

    function setPhone($phone) 
    {
        $this->phone = $phone;
        return $this;
    }

    function setCity($city) 
    {
        $this->city = $city;
        return $this;
    }

    function setUf($uf) 
    {
        $this->uf = $uf;
        return $this;
    }

    function setCpf($cpf) 
    {
        $this->cpf = $cpf;
        return $this;
    }

    function setAddress($address) 
    {
        $this->address = $address;
        return $this;
    }

    function setType($type) 
    {
        $this->type = $type;
        return $this;
    }

    function setDepartment($department) 
    {
        $this->department = $department;
        return $this;
    }

    function setStatus($status) 
    {
        $this->status = $status;
        return $this;
    }
        
    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }

}
