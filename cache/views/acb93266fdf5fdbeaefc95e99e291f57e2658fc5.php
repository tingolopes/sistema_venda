<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clientes</title>

    <?php headCss(); ?>
  </head>
  <body>

<?php include 'nav.php'; ?>

<div class="container">

<div class="page-header">
  <h1><i class="fa fa-heart"></i> Clientes</h1>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Clientes</h3>
  </div>
  <div class="panel-body">
    <form class="form-inline" role="form" method="get" action="">
      <div class="form-group">
        <label class="sr-only" for="fq">Pesquisa</label>
        <input type="search" class="form-control" id="fq" name="q" placeholder="Pesquisa" value="<?php echo $q; ?>">
      </div>
      <button type="submit" class="btn btn-default">Pesquisar</button>
    </form>
  </div>

  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th></th>
        <th>Nome</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      
        <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resultado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr>
        <td><?php echo e($resultado['idcliente']); ?></td>
        <td>

          <?php if($resultado['ativo'] == CLIENTE_ATIVO): ?>
            <span class="label label-success">ativo</span>
          <?php else: ?>
            <span class="label label-warning">inativo</span>
          <?php endif; ?>

        </td>

        <td><?php echo e($resultado['nome']); ?></td>

        <td>
          <a href="clientes-editar.php?idcliente=<?php echo e($resultado['idcliente']); ?>" title="Editar cliente"><i class="fa fa-edit fa-lg"></i></a>
          <a href="clientes-apagar.php?idcliente=<?php echo e($resultado['idcliente']); ?>" title="Remover cliente"><i class="fa fa-times fa-lg"></i></a>
        </td>
        </tr>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    </tbody>
  </table>
</div>

</div>

<script src="./lib/jquery.js"></script>
<script src="./lib/bootstrap/js/bootstrap.min.js"></script>

  </body>
</html>