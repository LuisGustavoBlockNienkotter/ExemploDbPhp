<?php 

abstract class AbsClassCodigoDesc 
{
	
	private $codigo;
	private $descricao;


	/**
	 * Class Constructor
	 * @param    $codigo   
	 * @param    $descricao   
	 */
	public function __construct($descricao)
	{
		$this->descricao = $descricao;
	}


	/**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     *
     * @return self
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * @param mixed $descricao
     *
     * @return self
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function __toString()
    {
    	return "Código: ". $this->getCodigo() ." | Descrição: ". $this->getDescricao();
    }
}






 ?>