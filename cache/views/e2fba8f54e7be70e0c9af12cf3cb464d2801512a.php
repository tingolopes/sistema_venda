<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastrar clientes</title>

    <?php headCss(); ?>

</head>
<body>

<?php echo $__env->make('nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="container">

    <div class="page-header">
        <h1><i class="fa fa-heart"></i> Cadastrar clientes</h1>
    </div>

    <?php echo $__env->make('alert', [ 'msg' => $msg ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <form role="form" method="post" action="clientes-cadastrar.php">
        <div class="form-group">
            <label for="fnome">Nome</label>
            <input type="text" class="form-control" id="fnome" name="nome" placeholder="Nome completo"
                   value="<?php echo e($nome); ?>">
        </div>
        <div class="form-group">
            <label for="femail">Email</label>
            <input type="email" class="form-control" id="femail" name="email" placeholder="email@email.com"
                   value="<?php echo e($email); ?>">
        </div>
        <div class="form-group">
            <label for="ffoto">Foto do cliente</label>
            <input type="file" id="ffoto" name="foto">
            <p class="help-block">Somente foto em JPG.</p>
        </div>
        <div class="checkbox">
            <label for="fativo">
                <input type="checkbox" name="ativo" id="fativo"

                       <?php if($ativo === CLIENTE_ATIVO): ?>
                       checked
                        <?php endif; ?>

                        {{--<?php if ($ativo == CLIENTE_ATIVO) { ?> checked<?php } ?>--}}

                > Cliente ativo

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