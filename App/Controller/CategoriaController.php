<?php

namespace App\Controller;

use App\Conexao;
use App\Dao\CategoriaDao;
use App\Vo\Categoria;
use Exception;
use PDO;

class CategoriaController extends Controller
{

    public function __construct()
    {
        require './protege.php';
        require './lib/funcoes.php';
        // require './lib/conexao.php';
    }

    public function cadastrarAction()
    {
        $msg = array();

        $nome = '';
        $email = '';
        $ativo = CLIENTE_ATIVO;

        if ($_POST) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $ativo = isset($_POST['ativo']) ? CLIENTE_ATIVO : CLIENTE_INATIVO;

            $cliente = new Cliente();
            $cliente->setNome($nome);
            $cliente->setEmail($email);
            $cliente->setAtivo($ativo);

            $clienteDao = new ClienteDao();

            try {
                $clienteDao->create($cliente);
                $url = 'clientes-editar.php?idcliente=' . $cliente->getIdcliente();
                $mensagem = 'Cliente cadastrado!';
                javascriptAlertFim($mensagem, $url);
            } catch (Exception $e) {
                $msg[] = $e->getMessage();
            }
        }

        $view = $this->view();
        echo $view->render('clientes-cadastrar', array(
            'nome' => $nome,
            'email' => $email,
            'ativo' => $ativo,
            'msg' => $msg
        ));

    }
}