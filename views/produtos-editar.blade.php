<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar produtos</title>

    <?php headCss(); ?>
  </head>
  <body>

<?php include 'nav.php'; ?>

<div class="container">

<div class="page-header">
  <h1><i class="fa fa-headphones"></i> Editar produtos</h1>
</div>

<?php if ($msg) { msgHtml($msg); } ?>

<form role="form" method="post" action="produtos-editar.php">
  
  <input type="hidden" name="idproduto" value="<?php echo $idproduto; ?>">
    
  <div class="form-group">
    <label for="fdescricao">Descrição</label>
    <input type="text" class="form-control" id="fdescricao" name="descricao" placeholder="Descrição do produto" value="<?php echo $descricao; ?>" required>
  </div>
    
  <div class="form-group">
    <label for="fpreco">Preço</label>
    <div class="input-group">
      <span class="input-group-addon">R$</span>
      <input type="text" class="form-control" id="fpreco" name="preco" placeholder="Preço" value="<?php echo $preco; ?>" required>
    </div>
  </div>
    
  <div class="form-group">
    <label for="fcategoria">Categoria</label>
    <select id="fcategoria" name="idcategoria" class="form-control" required>
        <option value="0">Selecione a categoria</option>
        <?php 
$sql = 'Select idcategoria,categoria from categoria where (status = 1)';
$exec = mysqli_query($con, $sql);
while($r = mysqli_fetch_assoc($exec)){

        ?>
        <option value="<?php echo $r['idcategoria']; ?>" <?php if($idcategoria == $r['idcategoria']){?> selected <?php } ?>><?php echo $r['categoria'];?></option>
       <?php } ?>
    </select>
  </div>
    
  <div class="form-group">
    <label for="fsaldo">Saldo</label>
    <input type="number" class="form-control" id="fsaldo" name="saldo" placeholder="Estoque" value="<?php echo $saldo; ?>" required>
  </div>

  <div class="checkbox">
    <label for="fativo">
      <input type="checkbox" name="ativo" id="fativo" <?php if ($ativo == 1){?>checked<?php } ?>> Produto ativo
    </label>
  </div>
    
  <button type="submit" class="btn btn-primary">Cadastrar</button>
  <button type="reset" class="btn btn-danger">Cancelar</button>
</form>

</div>

<script src="./lib/jquery.js"></script>
<script src="./lib/bootstrap/js/bootstrap.min.js"></script>

  </body>
</html>