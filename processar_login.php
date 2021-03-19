<?
session_start();
//verificar se houve preenchimento dos campos das variáveis
if (!empty($_POST) AND (empty($_POST['nome']) OR empty($_POST['password']))){
	header ("Location:login.php");
	exit;
}

//ligar à base de dados
$ligacao = mysql_connect ('localhost', 'ob2nv6l6_aeaaa2', 'lourosa343535') or die ('Não foi possível ligar a base de dados');
 mysql_select_db('ob2nv6l6_aeaaamorim2', $ligacao)or die (mysql_error($ligacao));
 

// definir variáveis $username e $password
$username = $_POST['nome'];   // aqui deve ser em maiúsculas e sem espaços
$password = $_POST['password'];    // aqui deve ser em maiúsculas e sem espaços
 $_SESSION['nome']='$username';
//consulta a base de dados

$sql = "SELECT nome_utilizador, palavra_passe FROM uilizadores WHERE nome_utilizador = '$username' 
AND palavra_passe = '$password' ";

$consulta = mysql_query ($sql);

// verificar se foram devolvidos dados

if (mysql_num_rows($consulta) ==1)
 { 

//remeter o utilizador conforme os dados obtidos
//se existem dados remete para o menu

header("Location:formularios.php");

//se não existem dados, remete para login
}


else { 
header ("Location:login.php");


exit;

}

?>