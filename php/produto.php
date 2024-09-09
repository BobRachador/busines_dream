<?php


include "conecta.php";

session_start();



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
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
    <style>
        .produto {

            margin: 3% auto;
            width: 65%;
            display: flex;
            justify-content: space-between;
            box-shadow: 1px 5px 6px 2px rgba(0, 0, 0, 0.1);
            border-top: 1px solid #ddd;
            padding: 3%;
            border-radius: 10px;
        }

        .capa_produto {
            width: 35%;
            position: relative;
        }

        #comprar {
            
            width: 100%;
            color: #FFF;
            padding: 3%;
            font-size: 1.4em;
            border-radius: 29px;
            transition: 0.2s;
            border: #fff 2px solid;
            margin-top:12px;
            background-color: #5e2129;
        }

        #add-car {
           background-color: #caa670;
            width: 100%;
            color: #FFF;
            padding: 2%;
            font-size: 1.1em;
            border-radius: 24px;
            transition: 0.3s;
            margin-top:12px;
        }
        #add-car a{
            text-decoration: none;
            color: #FFF;
        }
        #add-car:hover {

             background-color: #CCB38D;
        }

        #comprar:hover {
            background-color: #7a4448;
        }

        h5 {
            margin-top: 5%;
        }

        .quantidade {
            background-color: #eee;
            margin: 10% auto 0;
            width: 100px;
            border: #aaa 1px solid;
            display: flex;
            justify-content: space-between;
            border-radius: 15px 15px 3px 3px;
            overflow: hidden;
        }

        #qtd {

            border: none;
            background-color: #fff;
            width: 24px;
        }

        #menos {
            background-color: #eee;
            width: 30px;
            height: 100%;
             border: none;
        }

        #mais {
            background-color: #eee;
            width: 30px;
            border: none;
        }

        #quant {
            padding-bottom: 15%;

        }
        .info_produto a{
            
            color: #333;
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
    </style>
</head>

<body>
    <?php
    include "menu.php";

    if (isset($_GET['id'])) {

        $id = $_GET['id'];


        $query = "SELECT * FROM produto WHERE id = $id";


        $resultado = $conexao->query($query);


        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
    ?>
            <div class="produto">
                <div class="capa_produto"><img src="../img_produtos/<?= $row['img'] ?>" id="image" alt="">

                </div>

                <div class="info_produto">
                    <h4><?= $row['nome'] ?></h4>
                    <p><?= $row['descricao'] ?></p>

                    <?php
                    $idvendedor = $row['id_vendedor'];
                    $quer = "SELECT * FROM usuarios WHERE id = $idvendedor";


                    $resultado2 = $conexao->query($quer);
            
            
                    if ($resultado2->num_rows > 0) {
                        $row2 = $resultado2->fetch_assoc();
                    ?>
                    <p>Vendedor <a href="vendedor.php?nome=<?= $row2['id'] ?>"><b><?= $row2['nome'] ?></b></a></p>
                    <?php
                    }
                    ?>

                </div>
                <div class="menu-compra">
                    <h5>Calcular Frete:</h5>
                    <form id="cepForm">
                        <label for="cep">CEP:
                            <input type="text" id="cep" placeholder="00000-000" maxlength="8" ></label>
                        <button type="submit" id="calcular">Calcular</button>
                    </form>
                    <div id="resultado"></div>
                    <script>
document.getElementById('cepForm').addEventListener('submit', function(event) {
  event.preventDefault();
  const cep = document.getElementById('cep').value.replace(/\D/g, '');

  if (cep.length !== 8) {
    alert('CEP inválido. Por favor, insira um CEP válido.');
    return;
  }

  fetch(`https://viacep.com.br/ws/${cep}/json/`)
    .then(response => response.json())
    .then(data => {
      if (data.erro) {
        alert('CEP não encontrado. Por favor, insira um CEP válido.');
      } else {
        document.getElementById('resultado').innerHTML = `
          <p><strong>CEP:</strong> ${data.cep}</p>
          <p><strong>Logradouro:</strong> ${data.logradouro}</p>
          <p><strong>Bairro:</strong> ${data.bairro}</p>
          <p><strong>Cidade:</strong> ${data.localidade}</p>
          <p><strong>Estado:</strong> ${data.uf}</p>
        `;
      }
    })
    .catch(error => {
      console.error('Ocorreu um erro ao consultar o CEP:', error);
      alert('Ocorreu um erro ao consultar o CEP. Por favor, tente novamente mais tarde.');
    });
});
</script>
                    <div class="quantidade">
                        <button id="menos" class="quant">-</button>
                        <input type="button" id="qtd" value="1">
                        <button id="mais" class="quant">+</button>
                    </div>
                    <button id="add-car"><a href="./car.php?action=add&idProduct=<?= $row['id'] ?>">Adicionar ao Carrinho</a></button>
                  
                    <button id="comprar" ><a href="finalizar.php?valor=<?= $row['preco'] ?>" style="text-decoration:none; color:#FFF"> R$: <?= $row['preco'] ?></a></button>


                </div>
            </div>
    <?php
    $categoria = $row['categoria'];
        } else {
            echo "Nenhum produto encontrado com a ID fornecida.";
        }
    } else {
        echo "Nenhuma ID foi fornecida.";
    }
    $sql = "SELECT * FROM produto WHERE categoria = '$categoria'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
     $i=1;
    ?>
    <hr>
    <h2 style="text-align: center;">Semelhantes</h2>

    <div class="container_vend">
    <?php
      while ($row1 = $result->fetch_assoc()) {
        if($i<6){
        ?>
          
      <div class="box"><a href="../php/produto.php?id=<?= $row1["id"] ?>">
          <div class="capa"><img src="../img_produtos/<?= $row1["img"] ?>" alt="<?= $row1["nome"] ?>"></div>
          <h5><?= $row1["nome"] ?></h5>
          <span class="preco">R$: <?= $row1["preco"] ?></span>
        </a>
      </div>

      <?php  
      $i++;
        }else{
          break;
        }
      }
 
    ?>
    
    
  </section>
    <?php
    }
    ?>
    <script>
     
        var quat = document.getElementById('qtd')
        var menos = document.getElementById("menos")
        var mais = document.getElementById("mais")

        mais.addEventListener("click", (e) => {
            var qtd = document.getElementById("qtd").value
            qtd++
            quat.value = qtd
        })
        menos.addEventListener("click", (e) => {
            var qtd = document.getElementById("qtd").value
            if (qtd >= 2) {
                qtd--
                quat.value = qtd
            }
        })
    </script>
</body>

</html>