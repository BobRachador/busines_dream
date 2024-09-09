<?php
session_start();

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Verifica se os campos de usuário e senha foram preenchidos
  if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha']) && !empty($_POST['verif_senha'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $verificar = $_POST['senha'];
    $verificar1 = $_POST['verif_senha'];
    if ($verificar === $verificar1) {
      
      include("conecta.php");      
      
      $hash = password_hash($verificar, PASSWORD_DEFAULT);
      
      $query = "INSERT INTO `usuarios`(`id`, `nome`, `email`,`telefone`, `senha`,`adm`) VALUES (default,'$nome','$email','$telefone','$hash',default)";
      $result = mysqli_query($conexao, $query);
      
      if($result){
          
          header("Location:login.php");
          exit();
      }
      }
      

  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Página de Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/formulario.css">
</head>

<body>
  <div class="login-container">
    <h2 style="text-align: center;">Cadastrar</h2>

    <form method="POST" class="form">
      <div class="input-group">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>
      </div>
      <div class="input-group">
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email" required>
      </div>
      <div class="input-group">
        <label for="telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone" placeholder="(00) 0000-0000"  maxlength="15" onkeyup="handlePhone(event)" required>
      </div>
      <script>
          const handlePhone = (event) => {
  let input = event.target
  input.value = phoneMask(input.value)
}

const phoneMask = (value) => {
  if (!value) return ""
  value = value.replace(/\D/g,'')
  value = value.replace(/(\d{2})(\d)/,"($1) $2")
  value = value.replace(/(\d)(\d{4})$/,"$1-$2")
  return value
}
      </script>
      <div class="input-group">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required>
      </div>
      <div class="input-group">
        <label for="senha">Senha</label>
        <input type="password" id="senha1" name="verif_senha" required>
        <h6 id="span"></h6>
      </div>
      <button type="submit" class="botao_login">Cadastrar</button>
    </form>
    <a href="./login.php">Já possui uma conta?</a>
  </div>
  <script>
    var verifica = document.querySelector("#senha1")
   
    var span = document.querySelector("#span")

    verifica.addEventListener('input', function() {
      const caractereInserido = this.value;
      const campoSenha = document.querySelector("#senha").value

      if (caractereInserido == campoSenha){
        span.textContent=""
      }else{
        verifica.style.border="1px solid red"
        span.textContent="Verifique se a senha é a mesma"
      }
        console.log('Caractere inserido:', caractereInserido);
      // Aqui você pode adicionar qualquer ação que deseja realizar quando um caractere for inserido
    });
  </script>
</body>

</html>