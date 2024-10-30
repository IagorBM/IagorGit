<?php

//session_name('mySessao');
session_start();


#if($_SESSION['login'] == FALSE){
#   session_destroy();
#  header("location: login.php");
#}


$var = $_GET['var'];



include_once("../banco/conect.php");
$obj = new conect(); #o conect é o nome da classe dentro da pasta conect.php
$resultado = $obj->ConectarBanco();

$sql = "SELECT * FROM contatos WHERE id_contatos=$var;";

$query = $resultado->prepare($sql);
$indice = 0;

if ($query->execute()) {
    while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
        $linhas[$indice] = $linha;
        $indice++;
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/edite.css" />
</head>

<body>
    <form method="post" action="editarCont.php?var=<? echo $var; ?> ">
        <div class="fundio">
            <table class="tabelEdit">
                <tr>
                    <th>Nome:</th>
                    <td align="center">
                        <label class="Botao" for="imagem" >
                            enviar foto
                        </label>
                        <input id="imagem" type="file" name="imagem" value="<? echo $linhas[0]["url_img"]; ?>" />
                    </td>
                </tr>
                <tr>
                    <th>Nome:</th>
                    <td><input type="text" name="name" value="<? echo $linhas[0]["nome"]; ?>" /></td>
                </tr>
                <tr>
                    <th>Endereço:</th>
                    <td><input type="text" name="ender" value="<? echo $linhas[0]["endereco"]; ?>" /></td>
                </tr>
                <tr>
                    <th>Telefone:</th>
                    <td><input type="text" name="tel" value="<? echo $linhas[0]["telefone"]; ?>" /></td>

                </tr>
                <tr>
                    <th>Celular:</th>
                    <td><input type="text" name="cel" value="<? echo $linhas[0]["celular"]; ?>" /></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><input type="email" name="email" value="<? echo $linhas[0]["email"]; ?>" /></td>
                </tr>
                <tr>
                    <td align="center" colspan="2"><input type="submit" value="Atualizar" name="atualizar"></td>
                </tr>
            </table>
        </div>


    </form>
</body>

</html>

<?php


/*include_once("../conect.php");
echo $sql = "SELECT nome, endereco, telefone, celular, email FROM contatos WHERE id_contatos = '".$var."';";
*/

extract($_POST);
if (isset($_POST["atualizar"])) {
    include_once('../banco/conect.php');
    $obj = new conect(); #o conect é o nome da classe dentro da pasta conect.php
    $resultado = $obj->ConectarBanco();

    echo $sql = "SELECT contatos WHERE id_contatos=$var;";


    echo $sql = "UPDATE contatos SET nome = '" . $_POST["name"] . "', endereco = '" . $_POST["ender"] . "', telefone = '" . $_POST["tel"] . "', celular='" . $_POST["cel"] . "', email='" . $_POST["email"] . "' WHERE id_contatos = '" . $var . "';";

    $query = $resultado->prepare($sql);
    if ($query->execute()) {
        header("location:agrenda.php");
    }
    unset($_POST["atualizar"]);
}
?>