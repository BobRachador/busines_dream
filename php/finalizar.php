<?php
session_start();
if(isset($_GET['valor']) && !empty($_GET['valor'])){
    $valor = $_GET['valor'];
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
  <link rel="stylesheet" href="css/style.css">
    <title>Pagamento</title>
</head>
<body>
    <div class="menu">
    <h1 id="nome1">Pagamento</h1>
        <h2>Valor Total: <?php echo $valor; ?></h2>
    </div>
</body>
</html>