<?php

namespace App\Controller;

use App\Dao\UsuarioDAO;
use App\Vo\Usuario;
use Exception;

class UsuarioController extends Controller
{

    public function __construct()
    {
        require './protege.php';
        require './lib/funcoes.php';
//        require './lib/conexao.php';
    }

    public function cadastrarAction()
    {

        $msg = array();
        $idusuario = '';
        $nome = '';
        $email = '';
        $senha = '';
        $status = USUARIO_ATIVO;

        if ($_POST) {
            $nome = trim($_POST['nome']);
            $email = trim($_POST['email']);
            $senha = trim($_POST['senha']);
            $senha2 = trim($_POST['senha2']);
            $status = isset($_POST['status']) ? USUARIO_ATIVO : USUARIO_INATIVO;

            if ($senha != $senha2) {
                $msg[] = "As senhas não coferem digite novamente";
            }
            if (strlen($nome) < 3) {
                $msg[] = "O campo Nome deve conter no minimo 3 caracteres";
            }

            $usuario = new Usuario();
            $usuario->setNome($nome);
            $usuario->setEmail($email);
            $usuario->setSenha($senha);
            $usuario->setStatus($status);

            $usuarioDao = new UsuarioDAO();

            try {
                $usuarioDao->create($usuario);
                $url = 'usuarios-editar.php?idusuario=' . $usuario->getIdusuario();
                $mensagem = 'Usuario cadastrado!';

                javascriptAlertFim($mensagem, $url);
            } catch (Exception $e) {
                $msg[] = $e->getMessage();
            }
        }

        $view = $this->view();
        echo $view->render('usuarios-cadastrar', array(
            'nome' => $nome,
            'email' => $email,
            'senha'=> $senha,
            'status'=> $status,
            'msg' => $msg
        ));

    }

}
