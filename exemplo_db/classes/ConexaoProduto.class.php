<?php 

require_once "autoload.php";

class ConexaoProduto extends Conexao
{

	public static $conexao_produto;

	private function __construct()
	{
				
	}

	public static function getInstance()
	{
		if (!isset(self::$conexao_produto)) {
			self::$conexao_produto = new ConexaoProduto();
		}
		return self::$conexao_produto;
	}
	

	public function inserir($produto)
	{
		if ($produto instanceof Produto) {
			$stmt = $this->getPdo()->prepare('INSERT INTO produto (descricao, preco, codigodebarra, marca_codigo) VALUES(:descricao, :preco, :codigodebarra, :marca_codigo)');
		    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
		    $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
		    $stmt->bindParam(':codigodebarra', $codigo_de_barra, PDO::PARAM_STR);
		    $stmt->bindParam(':marca_codigo', $marca_codigo, PDO::PARAM_STR);
		    $descricao = $produto->getDescricao();
		    $preco = $produto->getPreco();
		    $codigo_de_barra = $produto->getCodigoDeBarra();
		    $marca_codigo = $produto->getMarca()->getCodigo();
		    $stmt->execute();
		}
		
	}

	public function selectAll()
	{
		try{
			$consulta = $this->getPdo()->query("SELECT * FROM produto;");
			$txt = "";
			while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
			    $txt.= "Código: {$linha['codigo']} - Descrição: {$linha['descricao']} - Preço: {$linha['preco']} - Codigo de Barra: {$linha['codigodebarra']} - Marca: {$linha['marca_codigo']}<br />";
			}
			return $txt;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function selectDesc($desc)
	{
		try{
			$stmt = $this->getPdo()->prepare("SELECT * FROM produto
					                           WHERE descricao
					                           LIKE :descricao
					                           ORDER BY descricao;");

		    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
		    $descricao = $desc;
		    $stmt->execute();
			$txt = "";
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
			    $txt.= "Código: {$linha['codigo']} - Descrição: {$linha['descricao']} - Preço: {$linha['preco']} - Codigo de Barra: {$linha['codigodebarra']} - Marca: {$linha['marca_codigo']}<br />";
			}
			return $txt;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function selectPreco($preco)
	{
		try{
			$stmt = $this->getPdo()->prepare("SELECT * FROM produto
					                           WHERE preco
					                           LIKE :preco
					                           ORDER BY preco;");

		    $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
		    $stmt->execute();
			$txt = "";
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
			    $txt.= "Código: {$linha['codigo']} - Descrição: {$linha['descricao']} - Preço: {$linha['preco']} - Codigo de Barra: {$linha['codigodebarra']} - Marca: {$linha['marca_codigo']}<br />";
			}
			return $txt;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function selectCodBarra($cod_barra)
	{
		try{
			$stmt = $this->getPdo()->prepare("SELECT * FROM produto
					                           WHERE codigodebarra
					                           LIKE :codigodebarra
					                           ORDER BY codigodebarra;");

		    $stmt->bindParam(':codigodebarra', $cod_barra, PDO::PARAM_STR);
		    $stmt->execute();
			$txt = "";
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
			    $txt.= "Código: {$linha['codigo']} - Descrição: {$linha['descricao']} - Preço: {$linha['preco']} - Codigo de Barra: {$linha['codigodebarra']} - Marca: {$linha['marca_codigo']}<br />";
			}
			return $txt;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function selectCodMarca($marca)
	{
		try{
			$stmt = $this->getPdo()->prepare("SELECT * FROM produto
					                           WHERE marca_codigo
					                           LIKE :marca_codigo
					                           ORDER BY marca_codigo;");

		    $stmt->bindParam(':marca_codigo', $cod, PDO::PARAM_STR);
		    $cod = $marca->getCodigo();
		    $stmt->execute();
			$txt = "";
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
			    $txt.= "Código: {$linha['codigo']} - Descrição: {$linha['descricao']} - Preço: {$linha['preco']} - Codigo de Barra: {$linha['codigodebarra']} - Marca: {$linha['marca_codigo']}<br />";
			}
			return $txt;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function selectCod($cod_barra)
	{
		try{
			$stmt = $this->getPdo()->prepare("SELECT * FROM produto
					                           WHERE codigodebarra
					                           LIKE :codigodebarra
					                           ORDER BY codigodebarra;");

		    $stmt->bindParam(':codigodebarra', $cod_barra, PDO::PARAM_STR);
		    $stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC)['codigo'];
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function delete($produto)
	{
		try{
			if ($produto instanceof Produto) {
				$stmt = $this->getPdo()->prepare('DELETE FROM produto WHERE codigo = :id');
			    $stmt->bindParam(':id', $id);

			    $id = $produto->getCodigo();
			    $stmt->execute();
			}
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function update($produto)
	{
		try{
		  $stmt = $this->getPdo()->prepare('UPDATE produto SET descricao = :descricao, preco = :preco, codigodebarra = :codigodebarra, marca_codigo = :marca_codigo WHERE codigo = :codigo');
		  $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
		  $stmt->bindParam(':descricao', $descricao,  PDO::PARAM_STR);
		  $stmt->bindParam(':preco', $preco, PDO::PARAM_STR);
		  $stmt->bindParam(':codigodebarra', $codigodebarra,  PDO::PARAM_STR);
		  $stmt->bindParam(':marca_codigo', $marca_codigo,  PDO::PARAM_INT);
		  $codigo = $produto->getCodigo();
		  $descricao = $produto->getDescricao();
		  $preco = $produto->getPreco();
		  $codigodebarra = $produto->getCodigoDeBarra();
		  $marca_codigo = $produto->getMarca()->getCodigo();
		  $stmt->execute();
	 	} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}
}



 ?>