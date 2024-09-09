<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (!empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['telefone'])) {

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

      include("conecta.php");      
      
      $id = $_SESSION['user_id'];
      
      $query = "UPDATE `usuarios` SET `nome`='$nome',`email`='$email',`telefone`='$telefone' WHERE id = $id";
      $result = mysqli_query($conexao, $query);
      
      if($result){
          
          header("Location:account.php");
          exit();
      }
      
      

  }
}
?>