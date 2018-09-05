<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar produtos</title>

  <?php headCss(); ?>
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">

    <div class="page-header">
        <h1><i class="fa fa-headphones"></i> Cadastrar produtos</h1>
    </div>

    @include('alert', [ 'msg' => $msg ])

    <form role="form" method="post" action="produtos-cadastrar.php">

        <div class="form-group">
            <label for="fdescricao">Descrição</label>
            <input type="text" class="form-control" id="fdescricao"
                   name="descricao" placeholder="Descrição do produto"
                   value="{{ $descricao }}">
        </div>

        <div class="form-group">
            <label for="fpreco">Preço</label>
            <div class="input-group">
                <span class="input-group-addon">R$</span>
                <input type="text" class="form-control" id="fpreco" name="preco"
                       placeholder="Preço" value="{{ $preco }}"
                       required>
            </div>
        </div>

        <div class="form-group">
            <label for="fcategoria">Categoria</label>
            <select id="fcategoria" name="idcategoria" class="form-control"
                    required>
                <option value="0">Selecione a categoria</option>

              @foreach($categorias as $categoria)
                  <option value="{{ $categoria['idcategoria'] }}"

                  @if ($idcategoria == $categoria['idcategoria'])
                      selected
                  @endif

                  >{{ $categoria['categoria'] }}</option>
              @endforeach

            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>

</div>

<script src="./lib/jquery.js"></script>
<script src="./lib/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>