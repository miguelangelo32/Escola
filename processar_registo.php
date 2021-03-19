<?
//ligar à base de dados
$ligacao = mysql_connect ("localhost", "aeaaamorim2", "lourosa") or die ('Não foi possível ligar a base de dados');
// ativar a base de dados pretendida
 mysql_select_db("aeaaamorim2", $ligacao)or die ('Não foi possível ligar a base de dados');
 //atribuir uma variável aos dados recolhidos do formulário
 $username = $_POST ['nome'];
 $password = $_POST ['password'];
 $email = $_POST ['email'];
 //criar a instrução para introduzir dados da tabela e executa-la
 $sql = "INSERT INTO utilizadores (nome_utilizador, palavra_passe, email) VALUES ('$username', '$password', '$email')"; 
 $consulta = mysql_query($sql);
 //mensagem de confirmação de registo inserido
 include ('menu.php');
 echo "O registo foi efetuado com sucesso!";
 ?>
 
 
 
 