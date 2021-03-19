<?php
 
$login = $_POST['nome'];
$senha = MD5($_POST['password']);
$connect = mysql_connect('localhost','aeaaamorim2','lourosa');
$db = mysql_select_db('aeaaamorim2');
$query_select = "SELECT nome_utilizador FROM uilizadores WHERE nome_utilizador = '$login' AND palavra_passe = '$senha'";
$select = mysql_query($query_select,$connect);
$array = mysql_fetch_array($select);
$logarray = $array['nome'];
$logarray = $array['password'];
 
 
    if($login == "" || $login == null){
        echo"<script language='javascript' type='text/javascript'>alert('O campo login deve ser preenchido');window.location.href='login.php';</script>";
 
        }
		else{
            if($logarray == $login){
 
                echo"<script language='javascript' type='text/javascript'>alert('Esse login já existe');window.location.href='login.php';</script>";
                die();
 
            }else{
                //$query = "INSERT INTO uilizadores (nome_utilizador,palavra_passe) VALUES ('$login','$senha')";
                $insert = mysql_query($query,$connect);
                 
                if($insert){
                    echo"<script language='javascript' type='text/javascript'>alert('Usuário cadastrado com sucesso!');window.location.href='http://www.aeaaamorim.com'</script>";
                }else{
                    echo"<script language='javascript' type='text/javascript'>alert('Não foi possível cadastrar esse usuário');window.location.href='login.php'</script>";
                }
            }
        }
?>


Read more: http://www.linhadecodigo.com.br/artigo/3561/criando-um-sistema-de-cadastro-e-login-com-php-e-mysql.aspx#ixzz4AMqVR1fB