<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Produtos</title>

  <?php headCss(); ?>
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">

  <div class="page-header">
    <h1><i class="fa fa-headphones"></i> Produtos</h1>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3 class="panel-title">Produtos</h3>
    </div>
    <div class="panel-body">
      <form class="form-inline" role="form" method="get" action="">
        <div class="form-group">
          <label class="sr-only" for="fq">Pesquisa</label>
          <select class="form-control" name="idcategoria">
            <option value="0">Categoria</option>

            <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

              <option value="<?php echo e($r['idcategoria']); ?>"

              <?php if($idcategoria == $r['idcategoria']): ?>
                selected
              <?php endif; ?>

              ><?php echo e($r['categoria']); ?></option>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

          </select>
          <input type="search" class="form-control" id="fq" name="q" placeholder="Pesquisa" value="<?php echo e($q); ?>">
        </div>
        <button type="submit" class="btn btn-default">Pesquisar</button>
      </form>
    </div>

    <table class="table table-striped table-hover">
      <thead>
      <tr>
        <th>#</th>
        <th></th>
        <th>Categoria</th>
        <th>Nome</th>
        <th></th>
      </tr>
      </thead>
      <tbody>

      <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $resultado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <tr>
        <td><?php echo e($resultado['idproduto']); ?></td>
        <td>

          <?php if($resultado['status'] == PRODUTO_ATIVO): ?>
            <span class="label label-success">ativo</span>
          <?php else: ?>
            <span class="label label-warning">inativo</span>
          <?php endif; ?>

        </td>

        <td><?php echo e($resultado['categoria']); ?></td>
        <td><?php echo e($resultado['produto']); ?></td>

        <td>
          <a href="produtos-editar.php?idproduto=<?php echo e($resultado['idproduto']); ?>" title="Editar produto"><i class="fa fa-edit fa-lg"></i></a>
          <a href="produtos-apagar.php?idproduto=<?php echo e($resultado['idproduto']); ?>" title="Remover produto"><i class="fa fa-times fa-lg"></i></a>
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