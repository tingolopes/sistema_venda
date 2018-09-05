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

            @foreach ($categorias as $r)

              <option value="{{ $r['idcategoria'] }}"

              @if ($idcategoria == $r['idcategoria'])
                selected
              @endif

              >{{ $r['categoria'] }}</option>

            @endforeach

          </select>
          <input type="search" class="form-control" id="fq" name="q" placeholder="Pesquisa" value="{{ $q }}">
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

      @foreach ($produtos as $resultado)

        <tr>
        <td>{{ $resultado['idproduto'] }}</td>
        <td>

          @if($resultado['status'] == PRODUTO_ATIVO)
            <span class="label label-success">ativo</span>
          @else
            <span class="label label-warning">inativo</span>
          @endif

        </td>

        <td>{{ $resultado['categoria'] }}</td>
        <td>{{ $resultado['produto'] }}</td>

        <td>
          <a href="produtos-editar.php?idproduto={{ $resultado['idproduto'] }}" title="Editar produto"><i class="fa fa-edit fa-lg"></i></a>
          <a href="produtos-apagar.php?idproduto={{ $resultado['idproduto'] }}" title="Remover produto"><i class="fa fa-times fa-lg"></i></a>
        </td>
        </tr>

      @endforeach

      </tbody>
    </table>
  </div>

</div>

<script src="./lib/jquery.js"></script>
<script src="./lib/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>