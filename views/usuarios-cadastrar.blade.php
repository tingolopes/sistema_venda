<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Alterar cadastro de usuário</title>

    <?php headCss(); ?>
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container">

    <div class="page-header">
        <h1><i class="fa fa-user"></i> Cadastrar usuário</h1>
    </div>

    <?php if ($msg) { msgHtml($msg); } ?>

    <form role="form" method="post" action="usuarios-cadastrar.php">
        <div class="form-group">
            <label for="fnome">Nome</label>
            <input type="text" class="form-control" id="fnome" name="nome" placeholder="Nome completo do usuário" value="<?php echo $nome; ?>">
        </div>

        <div class="form-group">
            <label for="femail">Email</label>
            <input type="email" class="form-control" id="femail" name="email" placeholder="Endereço de email" value="<?php echo $email; ?>">
        </div>

        <div class="row">
            <div class="form-group col-sm-6 col-xs-6">
                <label for="fsenha">Senha</label>
                <input type="password" class="form-control" id="fsenha" name="senha" placeholder="Senha do usuário">
            </div>

            <div class="form-group col-xs-6">
                <label for="fsenha2">Repita a senha</label>
                <input type="password" class="form-control" id="fsenha2" name="senha2" placeholder="Confirme a senha">
            </div>
        </div>

        <div class="checkbox">
            <label for="fativo">
                <input type="checkbox" name="ativo" id="fativo" <?php if ($status == USUARIO_ATIVO) { ?>checked<?php } ?>> Usuário ativo
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="reset" class="btn btn-danger">Cancelar</button>
    </form>

</div>

<script src="./lib/jquery.js"></script>
<script src="./lib/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>