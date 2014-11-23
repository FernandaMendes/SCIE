<?php

namespace CECUser\Entity;

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
     * @ORM\Column(name="user_name", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="user_password", type="string", length=255, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="user_salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var boolean
     *
     * @ORM\Column(name="user_activate", type="boolean", nullable=true)
     */
    private $active;

    /**
     * @var string
     *
     * @ORM\Column(name="user_activation_key", type="string", length=255, nullable=false)
     */
    private $activationKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="user_ip", type="string", length=45, nullable=true)
     */
    private $ip;
    
    /**
     * @var string
     *
     * @ORM\Column(name="user_cnpj", type="string", length=255, nullable=false)
     */
    private $cnpj;
    
    /**
     * @var string
     *
     * @ORM\Column(name="user_fantasy_name", type="string", length=255, nullable=false)
     */
    private $fantasyName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="user_url", type="string", length=255, nullable=true)
     */
    private $url;
    
    /**
     * @var string
     *
     * @ORM\Column(name="user_phone", type="string", length=255, nullable=false)
     */
    private $phone;
    
    /**
     * @var string
     *
     * @ORM\Column(name="user_city", type="string", length=255, nullable=false)
     */
    private $city;
    
    /**
     * @var string
     *
     * @ORM\Column(name="user_uf", type="string", length=2, nullable=false)
     */
    private $uf;
    
    /**
     * @var int
     *
     * @ORM\Column(name="user_status", type="string", nullable=true)
     */
    private $status;
    
    public function __construct(array $options = array()) 
    {
        /*
        $hydrator = new Hydrator\ClassMethods;
        $hydrator->hydrate($options, $this);
        */
        
        $this->salt = base64_encode(Rand::getBytes(8, true));
        //$this->password = $this->encryptPassword(Rand::getString(8));
        $this->password = " ";
        (new Hydrator\ClassMethods)->hydrate($options,$this);
        
        $this->activationKey = md5($this->email.$this->salt);
        
        
    }
    
    
    
    public function toArray()
    {
        return (new Hydrator\ClassMethods())->extract($this);
    }

}
