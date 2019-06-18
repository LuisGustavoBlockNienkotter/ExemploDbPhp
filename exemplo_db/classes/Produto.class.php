<?php

require_once "autoload.php";

class Produto extends AbsClassCodigoDesc
{
	private $preco;
	private $codigo_de_barra;
	private $marca;


	/**
	 * Class Constructor
	 * @param    $preco   
	 * @param    $codigo_de_barra   
	 * @param    $marca   
	 */
	public function __construct($descricao, $preco, $codigo_de_barra, $marca)
	{
		parent::__construct($descricao);
		$this->preco = $preco;
		$this->codigo_de_barra = $codigo_de_barra;
		$this->marca = $marca;
	}


	

    /**
     * @return mixed
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * @param mixed $preco
     *
     * @return self
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCodigoDeBarra()
    {
        return $this->codigo_de_barra;
    }

    /**
     * @param mixed $codigo_de_barra
     *
     * @return self
     */
    public function setCodigoDeBarra($codigo_de_barra)
    {
        $this->codigo_de_barra = $codigo_de_barra;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param mixed $marca
     *
     * @return self
     */
    public function setMarca($marca)
    {
        $this->marca = $marca;

        return $this;
    }

    public function __toString()
    {
    	return "Produto || Preço: ". $this->getPreco() ." | Código de Barra: ". $this->getCodigoDeBarra(). " | Marca: ". $this->getMarca(). " | ". parent::__toString();
    }
}




 ?>