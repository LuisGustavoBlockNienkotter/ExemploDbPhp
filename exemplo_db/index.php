<?php 

require_once "autoload.php";

$conexaoMarca = ConexaoMarca::getInstance();
$conexaoProduto = ConexaoProduto::getInstance();

$marca = new Marca("LG");
$marca->setCodigo(1);

$produto = new Produto("Celular", "1000.00", "1234567899", $marca);
$produto->setCodigo($conexaoProduto->selectCod("1234567899"));

$produto->setPreco("300");

$conexaoProduto->update($produto);
echo $conexaoProduto->selectAll();



 ?>