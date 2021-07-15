<?php
    class Cliente
    {
        public static function listarClientes(){
            $con = Connection::getConn();
            $sql = "SELECT * FROM cliente ORDER BY id_cliente";
            $sql = $con->prepare($sql);
            $sql->execute();
            $resultado = array();
            while($row = $sql->fetchObject('Cliente')){
                $resultado[] = $row;
            }

            if(!$resultado){
                throw new Exception("Não foi encontrado nenhum registro no banco");
            }

            return $resultado;
        }

        public static function especificarCliente($idCliente){
            $con = Connection::getConn();
            $sql = "SELECT * FROM cliente WHERE id_cliente=:id_cliente";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id_cliente', $idCliente, PDO::PARAM_INT);
            $sql->execute();
            $resultado =$sql->fetchObject('Cliente');

            if(!$resultado){
                throw new Exception("Não foi encontrado nenhum registro no banco");
            }

            return $resultado;
        }

        public static function insert($dadosCliente){
            if(empty($dadosCliente['nomeform']) || empty($dadosCliente['enderform'])){
                throw new Exception("Preencha os campos!");
                return false;
            }

            $con = Connection::getConn();
            $sql = "INSERT INTO cliente (nome_cliente, ender_cliente, bairro_cliente,
cidade_cliente, cep_cliente, uf_cliente, telefone_cliente, celular_cliente
) VALUES (:nom,:endereco, :bairro, :cidade, :cep, :uf, :telefone, :celular)";
            $sql = $con->prepare($sql);
            $sql->bindValue(':nom', $dadosCliente['nomeform']);
            $sql->bindValue(':endereco', $dadosCliente['enderform']);
            $sql->bindValue(':bairro', $dadosCliente['bairroform']);
            $sql->bindValue(':cidade', $dadosCliente['cidadeform']);
            $sql->bindValue(':cep', $dadosCliente['cepform']);
            $sql->bindValue(':uf', $dadosCliente['ufform']);
            $sql->bindValue(':telefone', $dadosCliente['telform']);
            $sql->bindValue(':celular', $dadosCliente['celform']);
            $res=$sql->execute();

            if($res==0){
                throw new Exception("Falha ao cadastrar cliente!");

                return false;
            }
            return true;
        }

        public static function update($dadosCliente){
            $con = Connection::getConn();
            $sql = "UPDATE cliente SET nome_cliente = :nom, ender_cliente=:endereco, bairro_cliente=:bairro,cidade_cliente = :cidade, cep_cliente= :cep, uf_cliente=:uf, telefone_cliente=:telefone, celular_cliente=:celular WHERE id_cliente=:id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $dadosCliente['id']);
            $sql->bindValue(':nom', $dadosCliente['nomeform']);
            $sql->bindValue(':endereco', $dadosCliente['enderform']);
            $sql->bindValue(':bairro', $dadosCliente['bairroform']);
            $sql->bindValue(':cidade', $dadosCliente['cidadeform']);
            $sql->bindValue(':cep', $dadosCliente['cepform']);
            $sql->bindValue(':uf', $dadosCliente['ufform']);
            $sql->bindValue(':telefone', $dadosCliente['telform']);
            $sql->bindValue(':celular', $dadosCliente['celform']);
            $res=$sql->execute();

            if($res==0){
                throw new Exception("Falha ao Alterar cliente!");

                return false;
            }
            return true;
        }

        public static function delete($idCliente){
            $con = Connection::getConn();
            $sql = "DELETE FROM cliente WHERE id_cliente=:id";
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idCliente);

            $res=$sql->execute();

            if($res==0){
                throw new Exception("Falha ao deletar cliente!");

                return false;
            }
            return true;
        }

    }