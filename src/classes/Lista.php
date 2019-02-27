<?php
class Lista {

    private $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getLista(){
        $array = array();

        $sql = $this->db->query("SELECT * FROM lista");
        if($sql->rowCount() > 0){
            $array = $sql->fetchAll();
        }
        return $array;
    }

    public function add($data){
        $nome = $data['nome'];
        $telefone = $data['telefone'];

        $sql = "INSERT INTO lista (nome, telefone) VALUES (:nome, :telefone)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":telefone", $telefone);
        $sql->execute();

    }

    public function getContato($id){
        $array = array();
        $sql = $this->db->prepare("SELECT * FROM lista WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();
        }

        return $array;
    }

    public function update($data, $id){

        $sql = $this->db->prepare("UPDATE lista SET nome = :nome, telefone = :telefone WHERE id = :id");
        $sql->bindValue(":nome", $data['nome']);
        $sql->bindValue(":telefone", $data['telefone']);
        $sql->bindValue(":id", $id);
        $sql->execute();

    }

    public function del($id){
        $sql = $this->db->prepare("DELETE FROM lista WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }   

}
?>