<?php

require './protege.php';
require './config.php';
require './lib/funcoes.php';
require './lib/conexao.php';

$msg = array();
$categoria = '';
$ativo = 1;

if ($_POST) {
  // Pegar informações
  $categoria = $_POST['categoria'];

  if(isset($_POST['ativo'])){
    $ativo = 1;
  } else {
    $ativo = 0;
  }
    
  // Validar informações
  if ($categoria == ''){
    $msg[] = 'Informe a categoria';
  }
    
  // Inserir
  if (!$msg){
    $sql = "insert into categoria
    values (null, '$categoria', '$ativo')";
    
    $resultado = mysqli_query($con, $sql);

    // Testar se foi inserido
    if (!$resultado) {
      $msg[] = 'Nao foi possivel inserir o registro.';
      $msg[] = mysqli_error($con); 
    } else {
      $idcategoria = mysqli_insert_id($con);
      $url = 'categorias-editar.php?idcategoria=' . $idcategoria;
      $mensagem = 'Categoria cadastrada!';  

      javascriptAlertFim($mensagem, $url);
    }

  }
}

?>