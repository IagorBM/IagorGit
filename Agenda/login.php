<?php
   session_start();
//session_name('Login');


?>
 <html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/login.css" />
    </head>
<body>
    <form action="login.php" method="post">
        <div class="content">
            <br />
            <h1>Login</h1>
            <input type="text" name="usuer" placeholder="Usuário" >
            <br />
            <br />
            <input type="password" name="senha" placeholder="Senha">
            <br />
            <br />


            <br />
            <br />
            <input type="submit" value="Entrar" name="Entrar" class="butao">


            <a href="cadas.php"><input type="button" value="Cadastrar" name="cadas" class="butao"></a>


        </div>
    </form>
</body>
</html>
<?php
    extract($_POST);
    if(isset($_POST["Entrar"])){


        include_once("banco/conect.php");
        $obj = new conect();
        $resultado = $obj->ConectarBanco();


        $usercripto = md5($_POST["usuer"]);
        $senhacripto = md5($_POST["senha"]);


        $sql = "SELECT NomeUsuario, senha, id_usuario FROM usuario WHERE NomeUsuario='".$usercripto."' AND senha = '".$senhacripto ."';";


        $query = $resultado->prepare($sql);
        $indice = 0;


   


        if($query->execute()){
            while($linha = $query->fetch(PDO::FETCH_ASSOC)){
                $linhas[$indice] = $linha;
                $indice++;
            }
       
       
        if($indice == 1){
           
            $_SESSION["Login"] = TRUE;
            $_SESSION["id"] = $linhas[0]["id_usuario"];
            $_SESSION["nomeUsuario"] = $linhas[0]["no"];;
            header("location: agenda/agrenda.php");
           
        }
        else{
            echo '
            <script>
            alert("Usuário e senha não existe");
            </script>';
        }
        }
    }
    unset($_POST["Entrar"]);
?>
