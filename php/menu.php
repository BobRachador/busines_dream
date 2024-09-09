<header>
  
    <nav>
      <div class="logo"><img src="../img/logo.png" alt=""></div>
      <div class="busca">
        <form action="buscar.php" method="GET"><input type="text" name="busca" placeholder="Buscar..."><button type="submit" class="lupa"><img src="../img/busca.png" alt=""></button></form>
      </div>

      <ul class="topo">
        <li><a href="../index.php">Home</a></li>
        <li><a href="categoria.php">Categorias</a></li>
        <li><a href="contato.php">Contato</a></li>
        <li><a href="account.php">Minha Conta</a></li>
      </ul>
      <div class="carrinho"><a href="car_compras.php"><img src="../img/carrinho.png" alt=""><h5 id="cont"><?php
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