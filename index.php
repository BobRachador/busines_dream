<?php
    session_start();
    include "php/conecta.php";
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
  <link rel="stylesheet" href="css/style.css">
  <title>BC</title>
</head>

<body>
  <header>
    <nav>
      <div class="logo"><img src="./img/logo.png" alt=""></div>
      <div class="busca">
        <form action="./php/buscar.php" method="GET"><input type="text" name="busca" placeholder="Buscar..."><button type="submit" class="lupa"><img src="./img/busca.png" alt=""></button></form>
      </div>

      <ul class="topo">
        <li><a href="#home">Home</a></li>
        <li><a href="./php/categoria.php">Categorias</a></li>
        <li><a href="./php/contato.php">Contato</a></li>
        <li><a href="./php/account.php">Minha Conta</a></li>
      </ul>
      <div class="carrinho"><a href="./php/car_compras.php"><img src="./img/carrinho.png" alt=""><h5 id="cont"><?php
      if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
      }else{
        foreach ($_SESSION['carrinho'] as $idProduct => $quantidade) {
             
           $es = count($_SESSION['carrinho']);
          
        }
        echo $es;
        }
      ?></h5></a></div>
    </nav>
  </header>
 
    
    <?php
 
    $sql = "SELECT * FROM produto ORDER BY vendas DESC";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
     $i=1;
      ?>
 <section>
  <h2>Mais Vendidos</h2>
  <div class="container_vend">
    <?php
      while ($row = $result->fetch_assoc()) {
        if($i<7){
        ?>
          
      <div class="box"><a href="./php/produto.php?id=<?= $row["id"] ?>">
          <div class="capa"><img src="./img_produtos/<?= $row["img"] ?>" alt="<?= $row["nome"] ?>"></div>
          <h5><?= $row["nome"] ?></h5>
          <span class="preco">R$: <?= $row["preco"] ?></span>
        </a>
      </div>

      <?php  
      $i++;
        }else{
          break;
        }
      }
 
    ?>
    
     </div>
    <?php
        if($i<5){     
          ?>
          <style>
            #prev{
              display: none;
            }
            #next{
              display: none;
            }
          </style>
           <?php
         }
    ?>
    <div class="botoes">
      <button id="prev" class="botao"><img src="./img/seta.png" alt=""></button>
      <button id="next" class="botao"><img src="./img/seta.png" alt=""></button>
    </div>
    
  </section>
  <hr>
  <?php
 }

  ?>
  <?php
    

    $sql1 = "SELECT * FROM produto";
    $result1 = $conexao->query($sql1);

    if ($result1->num_rows > 0) {
     $i1=1;
      ?>
 <section>
  <h2>Mais Procurados</h2>

  <div class="container_busca">
    <?php
      while ($row1 = $result1->fetch_assoc()) {
if($i1<7){
       
        ?>
    
      <div class="box1"><a href="./php/produto.php?id=<?= $row1["id"] ?>">
          <div class="capa"><img src="./img_produtos/<?= $row1["img"]?>" alt="<?= $row1['nome'] ?>"></div>
          <h5><?= $row1['nome'] ?></h5>
          <span class="preco">R$: <?= $row1['preco'] ?></span>
        </a>
      </div>
      <?php

      $i1++;  
     }else{
      break;
     }
    }
  if($i1<5){
        ?>
        <style>
            #prev1{
              display: none;
            }
            #next1{
              display: none;
            }
          </style>
        <?php
  }
      ?>
    </div>


   
    <div class="botoes">
      <button id="prev1" class="botao"><img src="./img/seta.png" alt=""></button>
      <button id="next1" class="botao"><img src="./img/seta.png" alt=""></button>
    </div>
    <?php
     } 
    ?>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const container_vend = document.querySelector('.container_vend');
      const boxes = document.querySelectorAll('.box');
      const prevButton = document.getElementById('prev');
      const nextButton = document.getElementById('next');
      const boxWidth = boxes[0].offsetWidth + 20; // Largura do item mais a margem
      const visibleItems = Math.floor(container_vend.offsetWidth / boxWidth); // Número de itens visíveis

      let currentIndex = 0;

      function nextSlide() {
        if (currentIndex < boxes.length - visibleItems) {
          currentIndex++;
          container_vend.style.transform = `translateX(-45%)`;
          if (currentIndex >= 2) {
            currentIndex = 0;
            container_vend.style.transform = `translateX(0)`;
          }
        }
      }

      function prevSlide() {
        if (currentIndex > 0) {
          currentIndex--;
          container_vend.style.transform = `translateX(0)`;
        }
      }

      prevButton.addEventListener('click', prevSlide);
      nextButton.addEventListener('click', nextSlide);



      const container_busca = document.querySelector('.container_busca');
      const boxes1 = document.querySelectorAll('.box1');
      const prevButton1 = document.getElementById('prev1');
      const nextButton1 = document.getElementById('next1');
      const boxWidth1 = boxes1[0].offsetWidth + 20; // Largura do item mais a margem
      const visibleItems1 = Math.floor(container_busca.offsetWidth / boxWidth1); // Número de itens visíveis

      let currentIndex1 = 0;

      function nextSlide1() {
        if (currentIndex1 < boxes1.length - visibleItems1) {
          currentIndex1++;
          container_busca.style.transform = `translateX(-45%)`;
          if (currentIndex1 >= 2) {
            currentIndex1 = 0;
            container_busca.style.transform = `translateX(0)`;
          }
        }
      }

      function prevSlide1() {
        if (currentIndex1 > 0) {
          currentIndex1--;
          container_busca.style.transform = `translateX(0)`;
        }
      }

      prevButton1.addEventListener('click', prevSlide1);
      nextButton1.addEventListener('click', nextSlide1);
    });
  </script>
</body>

</html>