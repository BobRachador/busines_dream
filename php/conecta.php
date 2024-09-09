<?php

$servidor = "localhost"; 
$usuario = "root"; 
$senha = ""; 
$banco = "loja";


$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verificando a conexão
if ($conexao->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conexao->connect_error);
}
?>
