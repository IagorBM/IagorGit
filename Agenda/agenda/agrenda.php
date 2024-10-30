<?php
session_start();
//session_name('Login');


if ($_SESSION['Login'] == FALSE) {
    session_destroy();
    header("location: login.php");
}



?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8"><!--os .. é para voltar-->
    <link rel="stylesheet" type="text/css" href="../css/agendacss.css" />



</head>

<body>
    <form method="post" action="agrenda.php" enctype="multipart/form-data">
        <script type="text/javascript" src="scripto.js"></script>

        <div class="ageFundo">
            <div class="datas">
                <table border="1px" class="agenda">

                    <tr><!--linha-->
                        <td rowspan="5"><input name="arquivo" type="file" class="texto" /></td>

                        <td colspan="2">Nome:<input type="text" name="name"></td><!--td é coluna-->
                    </tr>
                    <tr>
                        <td colspan="2">Endereço:<input type="text" name="ender"></td>
                    </tr>
                    <tr>
                        <td colspan="2">Telefone:<input type="text" name="tel"></td>
                    </tr>
                    <tr>
                        <td>Celular:<input type="text" name="cel"></td>
                        <td>Email:<input type="email" name="email"></td>
                    </tr>
                    <tr>


                    </tr>

                    <td colspan="3" style="position: relative; content: left ;">
                        <input type="submit" name="inserir" value="inserir">
                        <input type="submit" name="contatos" value="contatos" onclick="contato()">
                    </td>
                </table>
            </div>







<?php

extract($_POST);

    if (isset($_POST["inserir"])) {
        include_once("../banco/conect.php");
        $obj = new conect();
        $resultado = $obj->ConectarBanco();
        #print "ta funcionando";

        $destino = 'fotos/' . $_FILES['arquivo']['name'];
        $arquivo_temp = $_FILES['arquivo']['tmp_name'];
        move_uploaded_file($arquivo_temp, $destino);

        $sql = "INSERT INTO contatos (nome,endereco,telefone,email,celular,url_img,usuarioFK) VALUES ('" . $_POST["name"] . "','" . $_POST["ender"] . "','" . $_POST["tel"] . "','" . $_POST["email"] . "','" . $_POST["cel"] . "','" . $destino . "'," . $_SESSION["id"] . ");";


        $query = $resultado->prepare($sql);
        $indice = 0;
        if ($query->execute()) {
            unset($_POST["inserir"]);
            #header("Location: agrenda.php");
        } else {
            print_r($linhas);
        }
    }


    if (isset($_POST["contatos"])) {
        include_once("../banco/conect.php");
        $obj = new conect();
        $resultado = $obj->ConectarBanco();


        $sql = "SELECT * FROM contatos WHERE usuariofk=" . $_SESSION["id"] . ";";


        $query = $resultado->prepare($sql);
        $indice = 0;
        if ($query->execute()) {
            echo '<table border="1" class="tabelaCont" id="tabelaCont">
                <tr>
                    <td>
                        Foto
                    </td>
                    <td>
                        Nome
                    </td>


                    <td >
                        Endereço
                    </td>


                    <td >
                        Celular
                    </td>


                    <td>
                        Telefone
                    </td>
                    <td>
                        Email
                    </td>
                    <td>
                        Editar
                    </td>
                    <td>
                        Exluir
                    </td>
                </tr>';


            while ($linha = $query->fetch(PDO::FETCH_ASSOC)) {
                $linhas[$indice] = $linha;


                echo '
                <tr>
                <td>
                        <img src="' . $linhas[$indice]["url_img"] . '" width="45px" />
                    </td>
                    <td>
                        ' . $linhas[$indice]["nome"] . '
                    </td>


                    <td alig>
                        ' . $linhas[$indice]["endereco"] . '
                    </td>


                    <td >
                        ' . $linhas[$indice]["celular"] . '
                    </td>


                    <td>
                        ' . $linhas[$indice]["telefone"] . '
                    </td>
                    <td>
                        ' . $linhas[$indice]["email"] . '
                    </td>
                    <td align="center">
                        <a class="editar" href="editarCont.php?var=' . $linhas[$indice]["id_contatos"] . '">&nbsp;</a>
                    </td>
                    <td align="center">
                        <a class="excluir" href="excluirCont.php?var=' . $linhas[$indice]["id_contatos"] . '">&nbsp;</a>
                    </td>
                </tr>
            
            ';
                $indice++;
            }


            echo '  </table>';
        }
    }


            /* */
            echo '
        <a href="logout.php">
            <div class="sair">
            </div>
        </a>
</div>
        

    </form>
    <script type="text/javascript" src="java.js"></script>
</body>

</html>

    ';
?>