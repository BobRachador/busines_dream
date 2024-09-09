<?php
session_start();
if($_GET['id']){
$id = $_GET['id'];
 include("conecta.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {

   

    $nome = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];


    $diretorio_destino = '../img_produtos/';

    // Gera um nome único para o arquivo
    $nome_unico = uniqid('imagem_', true); // Prefixo 'imagem_' seguido de uma string única baseada no timestamp atual

    // Obtém a extensão do arquivo original
    $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);

    // Define o nome final do arquivo (incluindo a extensão)
    $nome_final = $nome_unico . '.' . $extensao;

    // Move o arquivo para o diretório de destino com o nome único
    if(move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio_destino . $nome_final)) {
        // Conecta ao banco de dados (substitua os valores pelos de sua configuração)
    

      

        // Fecha a conexão com o banco de dados
        
    } else {
        echo "Ocorreu um erro ao enviar o arquivo.";
    }
 $id_vendedor = $_SESSION['user_id'];
 if(!empty($_FILE['imagem'])){
    $sql = "UPDATE `produto` SET `nome`='$nome',`descricao`='$descricao',`categoria`='$categoria',`preco`='$preco',`img`='$nome_final' WHERE id = $id";
 }else{
     $sql = "UPDATE `produto` SET `nome`='$nome',`descricao`='$descricao',`categoria`='$categoria',`preco`='$preco' WHERE id = $id";
 }
    // Preparar e executar a query SQL para inserir os dados na tabela de produtos
   

    if ($conexao->query($sql) === TRUE) {
        header("location: account.php?concluido");
    } else {
        echo "Erro ao cadastrar o produto: " . $conexao->error;
    }

    // Fechar a conexão
    $conexao->close();
}
$sql = "SELECT * FROM produto WHERE id = '$id'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
 
      
      while ($row = $result->fetch_assoc()) {

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Noto+Sans:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="../css/formulario.css">
    <style>
        .inma{
            background-color: #eee;
            border-radius: 5px;
         
        }
        #imagem{
            display: none;
        }
        .remove{
            width: 30px;
            height: 30px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 style="text-align: center;">Cadastrar Produto</h2>

        <form method="POST" class="form" enctype="multipart/form-data">
            <div class="input-group">
                <label for="imagem" class="inma" style="cursor:pointer;display:none;"><img src="../img/up.png" alt="" width="50px" > Selecionar Imagem</label><br>
                <input type="file" id="imagem"  name="imagem" value="<?= $row['img'] ?>" onchange="mostrarPreview(event)" ><br>
                <img id="imagem-preview" src="../img_produtos/<?= $row['img'] ?>" style="max-width: 200px; max-height: 200px;">
                <button type="button" class="remove" onclick="removerImagem()" style="border: none; border-radius: 50%">X</button>
            </div>
            <div class="input-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value="<?= $row['nome'] ?>" required>
            </div>
             <div class="input-group">
                <label for="descricao">Descrição</label>
                 <input type="text" name="descricao" id="descricao" value="<?= $row['descricao'] ?>" required>
            </div>
            <div class="input-group">
                <label for="categoria">Categoria</label>
                <input type="text" name="categoria" id="categoria" value="<?= $row['categoria'] ?>" required>
            </div>
           
            <div class="input-group">
                <label for="preco">Preço</label>
                <input type="text" name="preco" id="numero" value="<?= $row['preco'] ?>" required>
            </div>
            <button type="submit" class="botao_login">Atualizar Produto</button>
        </form>
    </div>
</body>
<script>
   
</script>
<script> 
var ima = document.querySelector(".inma")
    function mostrarPreview(event) {
        const input = event.target;
        const reader = new FileReader();
       

        reader.onload = function() {
            const imagemPreview = document.getElementById('imagem-preview');
            
            imagemPreview.src = reader.result;
            imagemPreview.style.display = 'block';
            ima.style.display='none'
        }

        reader.readAsDataURL(input.files[0]);
    }
    function removerImagem() {
  var inputFile = document.getElementById('imagem');
  inputFile.value = ''; // Limpa o valor do input file
  var preview = document.getElementById('imagem-preview');
  preview.style.display = 'none'; // Oculta a imagem de preview
  ima.style.display='block'
}
</script>

</html>
<?php
}
}
}
?>