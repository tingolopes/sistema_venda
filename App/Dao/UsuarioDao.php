<?php

namespace App\Dao;

use App\Conexao;
use App\Vo\Usuario;
use InvalidArgumentException;

class UsuarioDao{

    public function create(Usuario $usuario){
        
        //valida as informações
        if ($usuario->getNome() == '') {
            throw new InvalidArgumentException('Informe um nome');
        }
        if ($usuario->getEmail() == '') {
            throw new InvalidArgumentException('Informe um email');
        }

        if($usuario->getSenha() == ''){
            throw new InvalidArgumentException('Informe uma senha');
        }

        $usuario->setStatus(Usuario::ATIVO);
        $sql = "INSERT INTO usuario (nome, email, senha, status) VALUES (:nome, :email, :senha, :status)";

        $con = Conexao::getConexao();

        $stmt = $con->prepare($sql);
        $stmt->bindValue(':nome', $usuario->getNome());
        $stmt->bindValue(':email', $usuario->getEmail());
        $stmt->bindValue(':senha', $usuario->getSenha());
        $stmt->bindValue(':status', $usuario->getStatus());

        $stmt->execute();

        $usuario->setIdusuario($con->lastInsertId());

        return true;

    }




}