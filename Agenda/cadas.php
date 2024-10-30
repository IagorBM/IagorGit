<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>Document</title>
   
    <style>
        body{
            position: relative;
            background-color: #F0F8FF;
            background: linear-gradient(180deg, rgb(99, 162, 243), aliceblue);
            height: 100%;
        }
        .content{
            background-color: aliceblue;    
            width: 350px;
            height: 300px;
            position: relative;
            left:40%;
            top:200px;
            text-align:center;
            border-radius:10px;
            border-color: rgb(212, 233, 252);


        }
        input{
            width: 200px;
            height: 25px;
        }
        .butao{
            width: 100px;
            height: 20px;
            border-radius:10px;
        }
    </style>
</head>
<body>
    <form method="post" action="cadas.php">
        <div class="content">
            <br>
            <h1>Cadastro</h1>
            <input type="text" name="usuer" placeholder="Usuário" >
            <br>
            <br>
            <input type="password" name="senha" placeholder="Senha">
            <br>
            <br>
            <input type="email" name="email" placeholder="Email">
            <br>
            <br>
           
            <input type="submit" value="Cadastro" name="Entrar" class="butao">
            <a href="login.php"><input type="button" value="Logar" name="Logar" class="butao"></a>


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
   


        $sql = "INSERT INTO usuario (NomeUsuario,senha,email) VALUES ('".$usercripto."','".$senhacripto."','".$_POST["email"]."');";


        $query = $resultado->prepare($sql);
        $indice = 0;
        if($query->execute()){
        }
        else{
            print_r($linhas);
        }
    }
?>
