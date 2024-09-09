<?php
    SESSION_START();
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
    <style>
      section{
        width: 90%;
      }
    </style>
    <title>Bc</title>
</head>
<body>
 
    <?php
        include "menu.php";
    include "conecta.php";
        
      if(isset($_GET['busca']) && !empty($_GET['busca'])){
        $busca = $_GET['busca'];
      }else{
        header("location: ../index.php");
      }
  

        $sql = "SELECT * FROM produto WHERE nome LIKE '%$busca%' OR categoria like '%$busca%' OR descricao like '%$busca%'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
    $i1=0;
      ?>
 <section>
  <h2>Resultados da Busca</h2>
  
    <?php
      while ($row = $result->fetch_assoc()) {
     $i1++;
            ?>
          
            <div class="box"><a href="produto.php?id=<?= $row["id"] ?>">
                <div class="capa"><img src="../img_produtos/<?= $row["img"] ?>" alt="<?= $row["nome"] ?>"></div>
                <h5><?= $row["nome"] ?></h5>
                <span class="preco">R$: <?= $row["preco"] ?></span>
              </a>
            </div>
      
            <?php  
        

        
      }
    }
      ?>
    </section>
</body>
</html>