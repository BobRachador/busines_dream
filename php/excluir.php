<?php
include('conecta.php');

// Verifica se o parâmetro 'id_usuario' foi fornecido e é um número inteiro
if (isset($_GET['id_produto']) && is_numeric($_GET['id_produto'])) {

    $recid = $_GET['id_produto'];

    $sql = "SELECT `img` FROM `produto` WHERE `id` = '$recid'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
     
      while ($row = $result->fetch_assoc()) {
   
    $arquivo = '../img_produtos/'.$row['img'];
      }
    }

// Verifica se o arquivo existe antes de tentar excluí-lo
if (file_exists($arquivo)) {
    // Tenta excluir o arquivo
    if (unlink($arquivo)) {
        echo "O arquivo foi excluído com sucesso.";
    } else {
        echo "Não foi possível excluir o arquivo.";
    }
}

    mysqli_query($conexao, "DELETE FROM produto WHERE id = '$recid'");

    header("location: account.php?excluido");

} else {

    echo "ID de usuário inválido!";

}
?>