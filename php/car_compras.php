<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location:login.php");
  }
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
    <title>Document</title>
    <style>
        fieldset {
            margin: 2%;
            width: 50%;
           border-radius: 15px;
        }

        .product {
            width: 100%;
            
        }

        #menos {
            background-color: #eee;
            width: 30px;
            height: 100%;
        }

        #mais {
            background-color: #eee;
            width: 30px;

        }

        #quant {
            padding-bottom: 15%;

        }

        
        .capa{
            padding: 3%;
        }
        table{
            width: 100%;
        }
        th{
            text-align: center;
            border-bottom: 1px #333 solid;
            padding: 2%;
        }
        td{
            text-align: center;
        }
        td a{
           background-color: rgba(224, 52, 52, 0.898); 
           border-radius: 50%;
           text-decoration: none;
           color: #eee;
           padding: 3%;
        }
        h2{
            margin-top: 1%;
            text-align: center;
        }
        #cont{
            background-color: #760d23;
            border-radius: 50%;
            margin-top: -15%;
            z-index: 1;
            color: #fff;
            text-align: center;
            width: 25px;
            text-decoration: none;
        }
       .coisa{
        display: flex;
        justify-content: space-between;
       }
       .finalizar{
        position: relative;
        text-align: center;
        width: 35%;
        border: 1px solid #333;
        border-radius: 15px;
        margin-right: 2%;
       }
       #comprar {
            position: absolute;
            bottom: 2%;
            left: 50%;
            transform: translateX(-50%);
        
            color: #FFF;
            padding: 3%;
            font-size: 1.4em;
            border-radius: 29px;
            transition: 0.2s;
            border: #fff 2px solid;
           
            background-color: #caa670;
        }
        #comprar:hover{
            background-color: #CCB38D;
        }
        #comprar a{
            text-decoration: none;
            color: #FFF;
        }
        .clean{
            position: absolute;
            top: 63%;
            
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            text-decoration: none;
            color: #333;
        }
        .finalizar h3{
            position: absolute;
            top:37%;
            left: 50%;
            transform: translateX(-50%);
        }
        .botoes{
            width: 45%;
            margin: 0 auto;
        }
        #vlr{
            background: none;
            border: none;
            cursor:default;
        }
    </style>
</head>

<body>


    <?php

    include "conecta.php";

    include "menu.php";
    // Verifica se o carrinho existe na sessão
    if (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
        echo "<h2>Seu carrinho está vazio</h2>";
    } else {
    ?>
        <h2>Carrinho de Compras</h2>
        <div class="coisa">
        <fieldset>
        <table>
<tr>
    <th>Produto</td>
    <th>Nome</th>
 <th>Preço</th>
 <th>Remover</th>
 
</tr>

            <?php
       
            foreach ($_SESSION['carrinho'] as $idProduct => $quantidade) {
             
                $query = "SELECT * FROM produto WHERE id = $idProduct";


                $resultado = $conexao->query($query);
$i=0;

                if ($resultado->num_rows > 0) {
                    $row = $resultado->fetch_assoc();
                    $i++;
            ?>
            <tr>
                    <td><div class="capa"><img src="../img_produtos/<?= $row["img"] ?>" alt=""></div></td>
                        
                        <td><h3><?= $row["nome"] ?> </h3></td>
                        
                    <td class="preco"><?php echo number_format(floatval($row["preco"])*$quantidade , 2, ',', '.')?></td>
                        <td><a href='./car.php?action=remove&idProduct=<?php echo $row["id"] ?>'>X</a></td>
                   </tr>
            <?php


                }
            }
           
            ?>
</table>
        </fieldset>
        <div class="finalizar">
        <h2>Finalizar Compra</h2>
        <form action="finalizar.php" method="GET">
        <h3>Valor Final: <input type="button" id="vlr"> </h3>
       <div class="botoes">
        <a href='car.php?action=clear' class="clean">Limpar Carrinho</a> <br>
 <button id="comprar" type="submit">
        Finalizar Compra
    </button></form>
    </div></div>
    </div>
    <?php

    }
    ?>

    <script>
        var itens = document.querySelectorAll('.preco');
        
        // Inicializar a variável para armazenar a soma
        var soma = 0;
        
        // Iterar sobre os elementos e somar seus valores
        itens.forEach(function(item) {
            soma += parseInt(item.textContent);
        });
        
        // Exibir o total
        document.getElementById('vlr').value = 'Total: ' + soma.toFixed(2);
    </script>
</body>

</html>