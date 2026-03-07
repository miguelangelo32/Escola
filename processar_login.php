<?php
session_start();

if (!empty($_POST) && (empty($_POST['nome']) || empty($_POST['password']) || empty($_POST['perfil']))) {
    header('Location:login.php');
    exit;
}

$ligacao = mysql_connect('localhost', 'ob2nv6l6_aeaaa2', 'lourosa343535') or die('Não foi possível ligar a base de dados');
mysql_select_db('ob2nv6l6_aeaaamorim2', $ligacao) or die(mysql_error($ligacao));

$username = $_POST['nome'];
$password = $_POST['password'];
$perfil = $_POST['perfil'];

$_SESSION['nome'] = $username;
$_SESSION['perfil'] = $perfil;

$sql = "SELECT nome_utilizador, palavra_passe FROM uilizadores WHERE nome_utilizador = '$username' AND palavra_passe = '$password'";
$consulta = mysql_query($sql);

if (mysql_num_rows($consulta) == 1) {
    if ($perfil == 'diretor') {
        header('Location:menu.php');
    } elseif ($perfil == 'funcionario') {
        header('Location:questionario.php');
    } else {
        header('Location:formularios.php');
    }
    exit;
}

header('Location:login.php');
exit;
?>
