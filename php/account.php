<?php
// Inicia a sessão
session_start();

// Verifica se a sessão está ativa
// Verifica se o ID do usuário está presente na sessão
if (!isset($_SESSION['user_id'])) {
  header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>minha conta</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/formulario.css">
  <style>
    .menu {
      text-align: center;
    }

    #nome1 {
      background-color: #5d0c1d;
      padding: 2%;
      color: #FFF;
    }

    .list-group a {

      color: #333;
    }

    .opcoes {
      width: 100%;
      transition: 0.5s;
      transform: 0.5s;
    }

    .login-container {
      margin-top: -10%;
      transition: 1s;
      animation: subir 1s;
    }

    @keyframes subir {
      form {
        transform: translateY(-10%);
      }

      to {
        transform: translateY(0);
      }
    }

    #sair {
      width: 45px;
      background: none;
      border: none;
      padding: 0.2%;
    }

    #sair:hover {
      border-radius: 50%;
      background-color: rgba(217, 213, 213, 0.761);
    }

    .compras {
      display: none;
      margin-top: -9%;
    }

    .vendas {
      display: none;
    }

    table {
      display: block;
      width: 55%;
      margin: 0 auto;
      border-radius: 10px;
    }

    th {
      border: #333 1px solid;
      background-color: rgba(217, 213, 213, 0.761);
      text-align: center;

    }

    td {
      height: 120px;
      width: 120px;
      border: #333 1px solid;
    }

    .imagen {
      height: 120px;
      width: 120px;
      overflow: hidden;
    }

    .imagen img {
      border-radius: 0;
    }

      a i img {
      width: 60px;
    }

    i img:hover {
      background-color: #CCB38D;
    }
  </style>
</head>

<body>
  <div class="menu">
    <style>
      .sucesso{
        width: 20%;
        z-index: 1;
        position: absolute;
        right: 20px;
       margin: 1%;
       border: #333 2px solid;
        background-color: #f0f0f0;
        border-radius: 15px;overflow: hidden;
        animation: coisa 3s;
        animation-fill-mode: forwards; 
      }
      @keyframes coisa{
        0%{transform: translateY(-150%);}

        50%{transform: translateY(0%);}

        90%{transform: translateY(-150%);}
      }
      .barra {
    width: 100%;
    background-color: #f0f0f0; 
    
}

#bar {
    width: 0; 
    height: 10px;
    background-color: rgb(6, 136, 6);
    animation: progressAnimation 2s;
}
@keyframes progressAnimation {
    from { width: 0; }
    
    to { width: 100%; }
}

.sucesso.animation-complete {
    display: none; /* Exibe após a animação ser concluída */
}
    </style>
  <?php
    if(isset($_GET['excluido'])){
      ?>
        <div class="sucesso" id="sucesso"><h5>
          Item Excluido com Sucesso!!!</h5>
          <div class="barra">
            <div class="bar" id="bar"></div>
          </div>
        </div>
      <?php
    }
    if(isset($_GET['concluido'])){
      ?>
        <div class="sucesso" id="sucesso"><h5>
          Item Cadastrado com Sucesso!!!</h5>
          <div class="barra">
            <div class="bar" id="bar"></div>
          </div>
        </div>
      <?php
    }
  ?>
<script>document.addEventListener("DOMContentLoaded", function() {
    var progressBar = document.getElementById('sucesso');
    progressBar.addEventListener('animationend', function() {
        progressBar.classList.add('animation-complete');
    });
});</script>
        
    <h1 id="nome1">Bem-vindo, <?php echo $_SESSION['username'] ?>!</h1>
    <div class="opcoes">
      <h2>Opções:</h2>


      <div class="list-group">
        <button type="button" class="list-group-item list-group-item-action" onclick="editar()">Editar Informações</button>
        <button type="button" class="list-group-item list-group-item-action" onclick="minhasCompras()">Minhas Compras</button>
        <button type="button" class="list-group-item list-group-item-action" onclick="minhasVendas()">Minhas Vendas</button>
        <button type="button" class="list-group-item list-group-item-action"><a href="./cadastrar_produto.php" style="text-decoration: none;">Cadastrar Produtos</a></button>
      </div>
      <form action="logout.php" method="post">
        <button type="submit" id="sair"><img src="../img/sair.png" alt=""></button>
      </form>
    </div>
    <?php
    include "conecta.php";
    $id = $_SESSION['user_id'];
    $sql = "SELECT * FROM `usuarios` WHERE id = '$id'";
    $result = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($result) > 0) {
      $user = mysqli_fetch_assoc($result);
    }
    ?>
    <div class="login-container" style="display: none;">
      <form action="atualizar_user.php" method="post">

        <div class="input-group">
          <label for="nome">Nome</label>
          <input type="text" id="nome" name="nome" value="<?= $user["nome"] ?>" required>
        </div>
        <div class="input-group">
          <label for="email">E-mail</label>
          <input type="text" id="email" name="email" value="<?= $user["email"] ?>" required>
        </div>
        <div class="input-group">
          <label for="telefone">Telefone</label>
          <input type="text" id="telefone" name="telefone" value="<?= $user["telefone"] ?>" placeholder="(00) 0000-0000" maxlength="15" onkeyup="handlePhone(event)" required>
        </div>


        <button type="submit" class="botao_login">Atualizar</button>
      </form>

    </div>
    <div class="compras">
      <h3>Você ainda não comprou nada</h3>
    </div>
    <div class="vendas">
      <h2>Meus produtos</h2>

      <table>
        <tr>
          <th>Produto</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Categoria</th>
          <th>Preço</th>
          <th>Vendas</th>
          <th colspan="2">Ações</th>
        </tr>
        <?php
        $sqlProduto = "SELECT * FROM `produto` WHERE id_vendedor = '$id'";
        $resulte = $conexao->query($sqlProduto);

        if ($resulte->num_rows > 0) {
          while ($row = $resulte->fetch_assoc()) {
        ?>
            <tr>
              <td class="imagen"><img src="../img_produtos/<?= $row['img'] ?>" alt=""></td>
              <td><?= $row['nome'] ?></td>
              <td style="font-size: 12px;"> <?= $row['descricao'] ?> </td>
              <td><?= $row['categoria'] ?></td>
              <td><?= $row['preco'] ?></td>
              <td><?= $row['vendas'] ?></td>
              <td><a href="editar_produto.php?id=<?= $row["id"] ?>"><i> <img src="../img/lapis.png" alt="" width="30px"></i></a> </td>
              <td><a href="#" onClick="verifica('<?= $row["id"] ?>')"><i><img src="../img/lixo.png" alt=""></i></a></td>
            </tr>
        <?php
          }
        }
        ?>
      </table>

    </div>
  </div>
  <script>
    var menu = document.querySelector(".opcoes")
    var compra = document.querySelector(".compras")
    var form = document.querySelector(".login-container")
    var vendas = document.querySelector(".vendas")

    function editar() {
      menu.style.width = "15%"
      form.style.display = "block"
      compra.style.display = "none"
      vendas.style.display = "none"
    }
    const handlePhone = (event) => {
      let input = event.target
      input.value = phoneMask(input.value)
    }

    const phoneMask = (value) => {
      if (!value) return ""
      value = value.replace(/\D/g, '')
      value = value.replace(/(\d{2})(\d)/, "($1) $2")
      value = value.replace(/(\d)(\d{4})$/, "$1-$2")
      return value
    }

    function minhasCompras() {
      menu.style.width = "15%"
      form.style.display = "none"
      compra.style.display = "block"
      vendas.style.display = "none"
    }

    function minhasVendas() {
      menu.style.width = "15%"
      form.style.display = "none"
      compra.style.display = "none"
      vendas.style.display = "block"
    }
    function verifica(id){
        if(confirm("Tem certeza que deseja Excluir permanentemente o usuário?")){
            window.location="excluir.php?id_produto="+id;
        }
    }
  </script>
</body>

</html>