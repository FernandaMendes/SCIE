<?php

namespace Report\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\Stdlib\Hydrator;

/**
 * CECUserUsers
 *
 * @ORM\Table(name="Report")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Report\Entity\ReportRepository")
 */
class Report {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="Warehouse\Entity\Warehouse")
     * @ORM\JoinColumn(name="armazem_id", referencedColumnName="id")
     */
    protected $warehouse;
    
    /**
     * @ORM\OneToOne(targetEntity="Provider\Entity\Provider")
     * @ORM\JoinColumn(name="fornecedor_id", referencedColumnName="id")
     */
    protected $provider;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=255, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="descricao", type="string", nullable=false)
     */
    private $descript;

    /**
     * @var string
     *
     * @ORM\Column(name="custo", type="float", nullable=false)
     */
    private $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="quantidade", type="integer", nullable=false)
     */
    private $qtde;

    /**
     * @var string
     *
     * @ORM\Column(name="dtCriacao", type="datetime", nullable=false)
     */
    private $dt;

    /**
     * @var int
     *
     * @ORM\Column(name="status", nullable=false)
     */
    private $status;

    public function __construct(array $options = array()) {
        /*
          $hydrator = new Hydrator\ClassMethods;
          $hydrator->hydrate($options, $this);
         */
        $this->dt = new \DateTime("now", new \DateTimeZone('America/Sao_Paulo'));
        (new Hydrator\ClassMethods)->hydrate($options, $this);
    }

    function getId() {
        return $this->id;
    }

    function getNome() {
        return $this->nome;
    }

    function getDescript() {
        return $this->descript;
    }

    function getCost() {
        return $this->cost;
    }

    function getQtde() {
        return $this->qtde;
    }

    function getDt() {
        return $this->dt;
    }

    function getStatus() {
        return $this->status;
    }
        
    function getWarehouse() {
        return $this->warehouse;
    }

    function getProvider() {
        return $this->provider;
    }

    function setId($id) {
        $this->id = $id;
        return $this;
    }

    function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    function setDescript($descript) {
        $this->descript = $descript;
        return $this;
    }

    function setCost($cost) {
        $this->cost = $cost;
        return $this;
    }

    function setQtde($qtde) {
        $this->qtde = $qtde;
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

    function setWarehouse($warehouse) {
        $this->warehouse = $warehouse;
        return $this;
    }

    function setProvider($provider) {
        $this->provider = $provider;
        return $this;
    }

    
    public function toArray() {
        #return (new Hydrator\ClassMethods())->extract($this);
        
        return array(
            'id' => $this->id,
            'nome' => $this->nome,
            'provider' => $this->provider->getId(),
            'warehouse'=>$this->warehouse->getId(),
            'status' => $this->status,
            'qtde' => $this->qtde,
            'descript' => $this->descript,
            'cost' => $this->cost,
            'dt' => $this->dt,
        );
    }

}
