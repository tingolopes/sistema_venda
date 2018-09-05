<?php

namespace App\Dao;

use App\Conexao;
use App\Vo\Cliente;
use InvalidArgumentException;

class ClienteDao
{

    public function create(Cliente $cliente)
    {
        //valida as informações
        if ($cliente->getNome() == '') {
            throw new InvalidArgumentException('Informe um nome');
        }
        if ($cliente->getEmail() == '') {
            throw new InvalidArgumentException('Informe um email');
        }


        $cliente->setAtivo(Cliente::ATIVO);

        $sql = "INSERT INTO cliente (nome, email, ativo) VALUES (:nome, :email, :ativo)";

        $con = Conexao::getConexao();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':nome', $cliente->getNome());
        $stmt->bindValue(':email', $cliente->getEmail());
        $stmt->bindValue(':ativo', $cliente->getAtivo());
        $stmt->execute();

        $cliente->setIdcliente($con->lastInsertId());

        return true;
    }

    public function delete(Cliente $cliente)
    {
        return $this->deleteById($cliente->getIdcliente());
    }

    public function deleteById($idcliente)
    {
        $sql = "DELETE FROM cliente WHERE idcliente = :idcliente";
        $con = Conexao::getConexao();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':idcliente', $idcliente);
        $stmt->execute();

        return true;
    }

    public function update(Cliente $cliente)
    {
        $sql = "UPDATE cliente SET nome = :nome, email = :email, ativo = :ativo WHERE idcliente = :idcliente";
        $con = Conexao::getConexao();

        $stmt = $con->prepare($sql);
        $stmt->bindValue('nome', $cliente->getNome());
        $stmt->bindValue('email', $cliente->getEmail());
        $stmt->bindValue('ativo', $cliente->getAtivo());
        $stmt->execute();

        return true;
    }
}