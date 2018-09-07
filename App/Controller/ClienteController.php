<?php

namespace App\Controller;

use App\Conexao;
use App\Dao\ClienteDao;
use App\Vo\Cliente;
use Exception;
use PDO;

class ClienteController extends Controller {

    public function __construct() {
        require './protege.php';
        require './lib/funcoes.php';
        // require './lib/conexao.php';
    }

    public function cadastrarAction() {
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

    public function listarAction() {

        $q = '';
        if (isset($_GET['q'])) {
            $q = trim($_GET['q']);
        }

        // Produtos
        $sql = "select * from cliente";
        if ($q != '') {
            $sql .= " where nome like '%$q%'";
        }
        $con = Conexao::getConexao();
        $clientes = $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        // require VIEWS . '/produtos.php';
        $view = $this->view();
        echo $view->render('clientes', array(
            'q' => $q,
            'clientes' => $clientes
        ));
    }

}
