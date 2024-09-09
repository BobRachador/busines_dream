<?php
session_start();

include("conecta.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // O formulário foi submetido, então processamos os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        // Verificar se a senha está correta
        if (password_verify($senha, $user['senha'])) {
            // Iniciar a sessão e armazenar os dados do usuário
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['nome'];

            
           header("Location: ../index.php"); 
        }else{
          header("Location: login.php?erro"); 
        }
    }else{
       header("Location: login.php?erro"); 
    }
    
}


unset($_SESSION['erro']);

$conexao->close();
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
    <h2 style="text-align: center;">Entrar</h2>
    
    <form method="POST" class="form">
        
      <div class="input-group">
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email" required>
      </div>
      <div class="input-group">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha" required>
      </div>
      <?php
            if(isset($_GET['erro'])){
                ?>
            <p style="color:red">Dados incorretos</p>
            <?php
}?>
      <button type="submit" class="botao_login">Entrar</button>
    </form>
    <a href="./cadastrar.php">Não possui uma conta?</a>
  </div>
</body>
</html>
