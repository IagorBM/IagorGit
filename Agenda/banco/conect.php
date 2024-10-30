<?php

class conect{
    private $host;
    private $BDnome;
    private $senha;
    private $usuario;
    private $portaBD;

    function __construct(){
        $this->host = "localhost";
        $this->BDnome = "agenda";
        $this->senha = "123456";
        $this->usuario = "postgres";
        $this->portaBD = "5433";
        
    }

    public function ConectarBanco(){
        try{
            $PDO = new PDO("pgsql:host=".$this->host.";port=".$this->portaBD.";dbname=".$this->BDnome,$this->usuario,$this->senha);
            return($PDO);
        }
        catch(PDOException $erro){
            $msg = 'Falha no acesso com o PostGres:'.$erro->getMessage();
            echo $msg;

            return(NULL);
        }
    }
}
?>