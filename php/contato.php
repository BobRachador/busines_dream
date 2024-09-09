<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/formulario.css">
    <title>Contato</title>
</head>
<body>
   
<div class="login-container">
    <h2 style="text-align: center;">Contato</h2>

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
        <label for="telefone">Sua Mensagem</label>
        <textarea name="mensagem" id="telefone" cols="80" rows="10" required style="max-width: 100%;"></textarea>
       
      </div>
      
      <button type="submit" class="botao_login">Contato</button>
    </form>
    
  </div>
</body>
</html>