<?php
//iniciar sessao
session_start();
//verificar se há uma sessão associada ao campo nome_utilizador
if  (empty ($_SESSION ['nome'])) {
//caso a sessão não esteja iniciada, volta à página de acesso
header ("Location:login.php");
exit ();
}
?>