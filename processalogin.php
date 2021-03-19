<?php
// começar ou retomar uma sessão
session_start();
 
// se vier um pedido para login
if (!empty($_POST)) {
 
	// estabelecer ligação com a base de dados
	mysql_connect("localhost", "aeaaa2", "lourosa343535") or die(mysql_error());
	mysql_select_db('ob2nv6l6_aeaaamorim2');
 
	// receber o pedido de login com segurança
	$username = mysql_real_escape_string($_POST['nome']);
	$password = sha1($_POST['password']);
 
	// verificar o utilizador em questão (pretendemos obter uma única linha de registos)
	$login = mysql_query("SELECT nome_utilizador, FROM uilizadores WHERE nome_utilizador = '$username' AND palavra_passe = '$password'");
 
	if ($login && mysql_num_rows($login) == 1) {
 
		// o utilizador está correctamente validado
		// guardamos as suas informações numa sessão
				$_SESSION['nome'] = mysql_result($login,1);
 
		echo "<p>Sess&atilde;o iniciada com sucesso como {$_SESSION['nome']}</p>";
	} else {
 
		// falhou o login
		echo "<p>Utilizador ou password invalidos. <a href=\"login.php\">Tente novamente</a></p>";
	}
}
?>