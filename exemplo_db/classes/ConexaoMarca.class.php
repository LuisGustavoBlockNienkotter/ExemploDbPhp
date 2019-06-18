<?php 

require_once "autoload.php";

class ConexaoMarca extends Conexao
{

	public static $conexao_marca;

	private function __construct()
	{
				
	}

	public static function getInstance()
	{
		if (!isset(self::$conexao_marca)) {
			self::$conexao_marca = new ConexaoMarca();
		}
		return self::$conexao_marca;
	}
	

	public function inserir($marca)
	{
		if ($marca instanceof Marca) {
			$stmt = $this->getPdo()->prepare('INSERT INTO marca (descricao) VALUES(:descricao)');
		    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
		    $descricao = $marca->getDescricao();
		    $stmt->execute();
		}
		
	}

	public function selectAll()
	{
		try{
			$consulta = $this->getPdo()->query("SELECT * FROM marca;");
			$txt = "";
			while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
			    $txt.= "Código: {$linha['codigo']} - Descrição: {$linha['descricao']}<br />";
			}
			return $txt;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function select($desc)
	{
		try{
			$stmt = $this->getPdo()->prepare("SELECT * FROM marca
					                           WHERE descricao
					                           LIKE :descricao
					                           ORDER BY descricao;");

		    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
		    $descricao = $desc;
		    $stmt->execute();
			$txt = "";
			while ($linha = $stmt->fetch(PDO::FETCH_ASSOC)) {
			    $txt.= "Código: {$linha['codigo']} - Descrição: {$linha['descricao']}<br />";
			}
			return $txt;
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function selectCod($desc)
	{
		try{
			$stmt = $this->getPdo()->prepare("SELECT * FROM marca
					                           WHERE descricao
					                           LIKE :descricao
					                           ORDER BY descricao;");

		    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
		    $descricao = $desc;
		    $stmt->execute();
			return $stmt->fetch(PDO::FETCH_ASSOC)['codigo'];
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function delete($marca)
	{
		try{
			if ($marca instanceof Marca) {
				$stmt = $this->getPdo()->prepare('DELETE FROM marca WHERE codigo = :id');
			    $stmt->bindParam(':id', $id);

			    $id = $marca->getCodigo();
			    $stmt->execute();
			}
		} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}

	public function update($marca)
	{
		try{
		  $stmt = $this->getPdo()->prepare('UPDATE marca SET descricao = :descricao WHERE codigo = :codigo');
		  $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
		  $stmt->bindParam(':descricao', $descricao,  PDO::PARAM_STR);
		  $codigo = $marca->getCodigo();
		  $descricao = $marca->getDescricao();
		  $stmt->execute();
	 	} catch(PDOException $e) {
		  echo 'Error: ' . $e->getMessage();
		}
	}
}



 ?>