<?php

namespace Provider\Entity;

use Doctrine\ORM\Mapping as ORM;

use Zend\Math\Rand,
    Zend\Crypt\Key\Derivation\Pbkdf2;

use Zend\Stdlib\Hydrator;

/**
 * CECUserUsers
 *
 * @ORM\Table(name="fornecedor")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Provider\Entity\ProviderRepository")
 */
class Provider
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
     * @ORM\Column(name="enderaco", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="dtIclusao", type="datetime", nullable=false)
     */
    private $dt;
    
    /**
     * @var int
     *
     * @ORM\Column(name="status", nullable=false)
     */
    private $status;
    
    public function __construct(array $options = array()) 
    {
        /*
        $hydrator = new Hydrator\ClassMethods;
        $hydrator->hydrate($options, $this);
        */
        $this->dt = new \DateTime("now", new \DateTimeZone('America/Sao_Paulo'));
        (new Hydrator\ClassMethods)->hydrate($options,$this);
        
    }
    
    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getPhone() {
        return $this->phone;
    }

    function getCity() {
        return $this->city;
    }

    function getUf() {
        return $this->uf;
    }

    function getAddress() {
        return $this->address;
    }

    function getDt() {
        return $this->dt;
    }

    function getStatus() {
        return $this->status;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    function setPhone($phone) {
        $this->phone = $phone;
        return $this;
    }

    function setCity($city) {
        $this->city = $city;
        return $this;
    }

    function setUf($uf) {
        $this->uf = $uf;
        return $this;
    }

    function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    function setDt($dt) {
        $this->dt = $dt;
        return $this;
    }

    function setStatus($status) {
        $this->status = $status;
        return $this;
    }

            
    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }

}
