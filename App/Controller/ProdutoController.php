<?php

namespace App\Controller;

use App\Conexao;
use App\Dao\ProdutoDao;
use App\Vo\Produto;
use Exception;
use PDO;

class ProdutoController extends Controller {

    public function __construct() {
        require './protege.php';
        require './lib/funcoes.php';
    }

    public function cadastrarAction() {

        $msg = array();
        $descricao = '';
        $preco = '';
        $idcategoria = 0;

        if ($_POST) {
            // Pegar informações
            $descricao = $_POST['descricao'];
            $preco = $_POST['preco'];
            $idcategoria = (int) $_POST['idcategoria'];

            $produto = new Produto();
            $produto->setProduto($descricao);
            $produto->setPreco($preco);
            $produto->setIdcategoria($idcategoria);

            $produtoDao = new ProdutoDao();

            try {
                $produtoDao->create($produto);

                $url = 'produtos-editar.php?idproduto=' . $produto->getIdproduto();
                $mensagem = 'Produto cadastrado!';

                javascriptAlertFim($mensagem, $url);
            } catch (Exception $e) {
                $msg[] = $e->getMessage();
            }
        }

        $sql = 'Select idcategoria,categoria from categoria where (status = 1)';
        $con = Conexao::getConexao();
        $consulta = $con->query($sql)->fetchAll();

        $view = $this->view();
        echo $view->render('produtos-cadastrar', array(
            'categorias' => $consulta,
            'idcategoria' => $idcategoria,
            'descricao' => $descricao,
            'preco' => $preco,
            'msg' => $msg
        ));
    }

    public function listarAction() {

        $idcategoria = 0;

        $q = '';
        if (isset($_GET['q'])) {
            $q = trim($_GET['q']);
        }
        if (isset($_GET['idcategoria'])) {
            $idcategoria = (int) $_GET['idcategoria'];
        }

        // Selecionar categorias
        $sql = 'Select idcategoria,categoria from categoria where (status = 1)';
        $con = Conexao::getConexao();
        $categorias = $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        // Produtos
        $sql = "Select produto.idproduto, produto, produto.status, categoria from produto inner join categoria on produto.idcategoria = categoria.idcategoria";
        $array = array();
        if ($q != '') {
            $array[] = "(produto like '%$q%')";
        }
        if ($idcategoria > 0) {
            $array[] = "(categoria.idcategoria = $idcategoria)";
        }
        if ($array) {
            $sql .= " Where " . join(' or ', $array);
        }
        $produtos = $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        // require VIEWS . '/produtos.php';
        $view = $this->view();
        echo $view->render('produtos', array(
            'idcategoria' => $idcategoria,
            'q' => $q,
            'categorias' => $categorias,
            'produtos' => $produtos
        ));
    }

    public function editarAction() {
        $msg = array();

        if ($_POST) {
            $idproduto = (int) $_POST['idproduto'];
        } else {
            $idproduto = (int) $_GET['idproduto'];
        }

        $sql = "Select * From produto
Where (idproduto = $idproduto)";

        $r = mysqli_query($con, $sql);

        if ($r->num_rows == 0) {
            $url = 'produtos.php';
            $msg = "Registro inexistente.";
            javascriptAlertFim($msg, $url);
        }

        $produto = mysqli_fetch_assoc($r);

        $descricao = $produto['produto'];
        $preco = $produto['preco'];
        $idcategoria = $produto['idcategoria'];
        $saldo = $produto['saldo'];
        $ativo = $produto['status'];

        if ($_POST) {
            // Pegar informações
            $descricao = $_POST['descricao'];
            $preco = $_POST['preco'];
            $saldo = (int) $_POST['saldo'];
            $idcategoria = (int) $_POST['idcategoria'];

            if (isset($_POST['ativo'])) {
                $ativo = PRODUTO_ATIVO;
            } else {
                $ativo = PRODUTO_INATIVO;
            }

            // Validar informações
            if ($descricao == '') {
                $msg[] = 'Informe a descrição do produto';
            }

            // Inserir
            if (!$msg) {
                $sql = "Update produto
        Set produto = '$descricao',
            preco = '$preco',
            status = '$ativo',
            idcategoria = $idcategoria,
            saldo = $saldo
        Where (idproduto = $idproduto)";

                $r = mysqli_query($con, $sql);

                if (!$r) {
                    $msg[] = 'Erro para atualizar o registro';
                    $msg[] = mysqli_error($con);
                } else {
                    $url = 'produtos-editar.php?idproduto=' . $idproduto;
                    $msg = "Produto $idproduto alterado.";

                    javascriptAlertFim($msg, $url);
                }
            }
        }
    }

    public function apagarAction() {
        $idproduto = (int) $_GET['idproduto'];

        $produtoDao = new ProdutoDao();
        $produtoDao->deleteById($idproduto);

        javascriptAlert('Produto apagado', 'produtos.php');
    }

}
