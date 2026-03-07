<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Login | Escola</title>
<style>
  :root {
    color-scheme: light;
    --azul: #0f4c81;
    --azul-escuro: #0b355a;
    --fundo: #f3f6fb;
    --texto: #1d2a39;
    --borda: #d6deea;
  }

  * {
    box-sizing: border-box;
  }

  body {
    margin: 0;
    min-height: 100vh;
    font-family: Arial, Helvetica, sans-serif;
    color: var(--texto);
    background: linear-gradient(rgba(243, 246, 251, 0.92), rgba(243, 246, 251, 0.92)), url('LogoAEAAAcor.jpg') center/cover no-repeat;
    display: grid;
    place-items: center;
    padding: 24px;
  }

  .login-card {
    width: 100%;
    max-width: 420px;
    background: #fff;
    border: 1px solid var(--borda);
    border-radius: 14px;
    box-shadow: 0 12px 40px rgba(15, 76, 129, 0.14);
    padding: 28px;
  }

  h1 {
    margin: 0 0 8px;
    font-size: 24px;
    color: var(--azul-escuro);
  }

  .subtitle {
    margin: 0 0 22px;
    font-size: 14px;
    color: #51657a;
  }

  label {
    font-size: 14px;
    font-weight: 700;
    display: block;
    margin-bottom: 6px;
  }

  input,
  select {
    width: 100%;
    border: 1px solid var(--borda);
    border-radius: 10px;
    padding: 11px 12px;
    font-size: 15px;
    margin-bottom: 14px;
    background-color: #fff;
  }

  input:focus,
  select:focus {
    outline: 2px solid #9cc2e3;
    border-color: #9cc2e3;
  }

  .actions {
    display: flex;
    gap: 10px;
    margin-top: 4px;
  }

  button,
  input[type="reset"] {
    border: 0;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 700;
    padding: 11px 14px;
    cursor: pointer;
    flex: 1;
  }

  button {
    background: var(--azul);
    color: #fff;
  }

  button:hover {
    background: var(--azul-escuro);
  }

  input[type="reset"] {
    background: #e8edf5;
    color: #243b53;
  }
</style>
</head>
<body>
  <form class="login-card" id="form_registo" name="form_registo" method="POST" action="processar_login.php">
    <h1>Autenticação</h1>
    <p class="subtitle">Acesso para diretor, professores e funcionários.</p>

    <label for="perfil">Perfil</label>
    <select name="perfil" id="perfil" required>
      <option value="" selected disabled>Selecione o perfil</option>
      <option value="diretor">Diretor</option>
      <option value="professor">Professor</option>
      <option value="funcionario">Funcionário</option>
    </select>

    <label for="nome">Nome de utilizador</label>
    <input type="text" name="nome" id="nome" autocomplete="username" required />

    <label for="password">Palavra-passe</label>
    <input type="password" name="password" id="password" autocomplete="current-password" required />

    <div class="actions">
      <button type="submit" name="entrar" id="entrar">Entrar</button>
      <input type="reset" name="apagar" id="apagar" value="Limpar" />
    </div>
  </form>
</body>
</html>
