<?php

class ProdutoDao{

    public function create(Produto $produto){

        //validacoes

        $produto->setStatus(Produto::INATIVO);
        $produto->saldo = 0;

        $sql = "INSERT INTO produto (produto, preco, status, idcategoria, saldo)
            VALUES (:produto, :preco, :status, :idcategoria, :saldo)";

        $con = Conexao::getConexao();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':produto', $produto->nomeproduto);
        $stmt->bindValue(':preco', $produto->preco);
        $stmt->bindValue(':status', $produto->getStatus());
        $stmt->bindValue(':idcategoria', $produto->idcategoria);
        $stmt->bindValue(':saldo', $produto->saldo);
        $stmt->execute();

        $produto->idproduto = $con->lastInsertId();

        return true;

    }

    public function update(Produto $produto){

        $sql = "UPDATE produto SET 
produto = :produto,
preco = :preco,
idcategoria = :idcategoria
WHERE idproduto = :idproduto";

        $con = Conexao::getConexao();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':produto', $produto->nomeproduto);
        $stmt->bindValue(':preco', $produto->preco);
        $stmt->bindValue(':idcategoria', $produto->idcategoria);
        $stmt->bindValue(':idproduto', $produto->idproduto);
        $stmt->execute();

        $produto->idproduto = $con->lastInsertId();

        return true;

    }

    public function delete(Produto $produto){

        $sql = "DELETE FROM produto
WHERE idproduto = :idproduto";

        $con = Conexao::getConexao();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':idproduto', $produto->idproduto);
        $stmt->execute();
        return true;
    }

    public function deleteById($idproduto){
        $produto = new Produto();
        $produto->idproduto = $idproduto;
        $this->delete($produto);
        return true;
    }

    public function ativar(Produto $produto){

        //validar

        $produto->setStatus(Produto::ATIVO);

        $sql = "UPDATE produto SET 
status = :status
WHERE idproduto = :idproduto";

        $con = Conexao::getConexao();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':status', $produto->getStatus());
        $stmt->bindValue(':idproduto', $produto->idproduto);
        $stmt->execute();
        return true;

    }

}