<?php

define('BD_NOME', 'Vendas');
define('BD_HOST', 'localhost');
define('BD_USUARIO', 'root');
define('BD_SENHA', '');

require 'Conexao.php';
require 'ProdutoDao.php';
require 'Produto.php';


//$conexao = Conexao::getConexao();

$prod = new Produto();
$prod->nomeproduto = 'X-Calabresa';
$prod->preco = 14.50;
//$prod->status = 1;
//$prod->setStatus(1);
$prod->idcategoria = 2;
//$prod->saldo = 99;

$prodDao = new ProdutoDao();
$prodDao->create($prod);

echo $prod->idproduto;

//update
$prod->nomeproduto = strtoupper($prod->nomeproduto);
$prod->preco = $prod->preco * 1.1;

$prodDao->update($prod);

$prodDao->deleteById(5);

$prodDao->ativar($prod);