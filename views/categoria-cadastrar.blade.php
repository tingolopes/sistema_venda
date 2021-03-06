<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar categorias</title>

    <?php headCss(); ?>
  </head>
  <body>

<?php include 'nav.php'; ?>

<div class="container">

<div class="page-header">
  <h1><i class="fa fa-cubes"></i> Cadastrar categorias</h1>
</div>

<?php if ($msg) { msgHtml($msg); } ?>

<form role="form" method="post" action="categorias-cadastrar.php">
    
  <div class="form-group">
    <label for="fcategoria">Categoria</label>
    <input type="text" class="form-control" id="fcategoria" name="categoria" placeholder="Nome da categoria" value="<?php echo $categoria; ?>">
  </div>

  <div class="checkbox">
    <label for="fativo">
      <input type="checkbox" name="ativo" id="fativo" <?php if ($ativo == 1){?>checked<?php } ?>> Categoria ativa
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