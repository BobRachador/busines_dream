<?php
session_start();



if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = array();
}

// Verifica a ação a ser executada
if (isset($_GET['action'])) {
    $idProdut = $_GET['idProduct'];
   

    switch ($_GET['action']) {
        case 'add':
            // Adiciona o item ao carrinho
            if (isset($_SESSION['carrinho'][$idProdut])) {
                $_SESSION['carrinho'][$idProdut]++;
              
            } else {
                $_SESSION['carrinho'][$idProdut] = 1;
            }
            break;
        case 'remove':
            // Remove o item do carrinho
            if (isset($_SESSION['carrinho'][$idProdut])) {
                $_SESSION['carrinho'][$idProdut]--;
           

                if ($_SESSION['carrinho'][$idProdut] <= 0) {
                    unset($_SESSION['carrinho'][$idProdut]);
                     unset($i);
                }
            }
            break;
        case 'clear':
            // Limpa o carrinho
            unset($_SESSION['carrinho']);
       
            break;
    }
   
}
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>